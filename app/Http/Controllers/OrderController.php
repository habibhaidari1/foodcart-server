<?php

namespace App\Http\Controllers;

use App\Exceptions\ExtraGroupNotValidException;
use App\Exceptions\InvalidStateException;
use App\Exceptions\PayPalException;
use App\Exceptions\RateNotFoundException;
use App\Extra;
use App\Mail\OrderCanceled;
use App\Mail\OrderCreated;
use App\Meta;
use App\Method;
use App\OpeningHour;
use App\Order;
use App\Position;
use App\Postcode;
use App\User;
use App\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PayPal;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cookies', 'auth', 'can:show-order'], ['only' => [
            'index',
        ]]);
        $this->middleware(['cookies', 'auth', 'can:update-order'], ['only' => [
            'update', 'destroy',
        ]]);
    }

    /**
     * Status überschreiben // TODO WAS ZURÜCKGEBEN?
     */
    public function update(Request $request, $id)
    {
        $data = $request->data;
        $order = Order::find($id);
        $order->state = $data['state'];
        return response()->json($order->save());
    }

    /**
     * Zeige alle Bestellungen der letzten zwei Tage
     */
    public function index(Request $request)
    {
        $timeFrom = $request->timeFrom ? Carbon::createFromTimestampMs($request->timeFrom) : Carbon::yesterday();
        return response()->json(
            Order::where('created_at', '>', $timeFrom)
                ->where('state', '<>', Order::STATE_PENDING_PAYMENT)
                ->orderBy('id', 'desc')
                ->with([
                    'user',
                    'rate',
                    'refundRate',
                    'referenceOrder',
                    'positions' => function ($query) {
                        $query->with(['variant' => function ($query) {
                            $query->with('food');
                            $query->with('variations');
                        }]);
                        $query->with('extras');
                    }, 'method', 'postcode' => function ($query) {
                        $query->with('region');
                        $query->with('cities');
                    }]
                )->get());
    }

    /**
     * Bestellung stornieren löschen
     */
    public function destroy($name)
    {
        $order = Order::with(['method', 'positions.extras', 'positions.variant', 'user', 'postcode', 'rate'])->find($name);
        if ($order->state == Order::STATE_CANCELED) {
            throw new InvalidStateException();
        }
        try {
            DB::beginTransaction();
            $order->state = Order::STATE_CANCELED;
            $order->save();
            $cancel = new Order([
                'name' => $order->name,
                'phone' => $order->phone,
                'street' => $order->street,
                'floor' => $order->floor,
                'notes' => $order->notes,
                'delivery' => $order->delivery,
                'paypal_payer_id' => $order->paypal_payer_id,
                'paypal_payment_id' => $order->paypal_payment_id,
                'paypal_capture_id' => $order->paypal_capture_id,
                'state' => Order::STATE_CLOSED,
                'ip' => $order->ip]);
            $cancel->referenceOrder()->associate($order);
            $cancel->user()->associate($order->user);
            $cancel->postcode()->associate($order->postcode);
            $cancel->method()->associate($order->method);
            $cancel->save();
            foreach ($order->positions as $position) {
                $positionModel = new Position(['quantity' => $position->quantity * (-1)]);
                $positionModel->variant()->associate($position->variant);
                $positionModel->order()->associate($cancel);
                $positionModel->save();
                foreach ($position->extras as $extra) {
                    $extra->positions()->attach($positionModel);
                }
            }
            if ($order->rate) {
                $cancel->refundRate()->associate($order->rate);
                $cancel->save();
            }

            if ($order->method_id == Method::METHOD_ID_PAYPAL) {
                $provider = PayPal::setProvider();
                $provider->getAccessToken();
                $resp = $provider->refundCapturedPayment($order->paypal_capture_id, $cancel->id, number_format($order->total / 100, 2, '.', ''), 'Wir haben deine Bestellung storniert. ');
                if ($resp['status'] != 'COMPLETED') {
                    throw new PayPalException();
                }
            }

            DB::commit();
            // Email senden
            Mail::to($cancel->user->email)->send(new OrderCanceled($cancel));
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Neue Bestellung validieren und speichern
     */
    public function store(Request $request)
    {
        $orderRules = array(
            'cart.*.variant_id' => 'required|exists:variants,id',
            'cart.*.extras.*.id' => 'required|exists:extras,id',
            'cart.*.quantity' => 'integer|min:1|required',
            'delivery' => 'integer|required',
            'email' => 'email|required',
            'location.postcode_id' => 'required|exists:postcodes,id',
            'method_id' => 'required|exists:methods,id',
            'name' => 'string|required',
            'phone' => 'string|required',
            'street' => 'string|required',
        );
        $data = $request->data;
        $validator = Validator::make($data, $orderRules);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // außerordentlich geschlossen
        $closed = Meta::where('name', '=', 'closed')->first();
        if ($closed != null && $closed->value) {
            throw new OpeningHourExceededException();
        }

        $moment = ((Carbon::now()->hour * 60) + Carbon::now()->minute);
        // Validieren der Zeit
        if ($data['delivery'] == -1) {
            OpeningHour::where('n', Carbon::now()->dayOfWeek)
                ->where('from', '<=', $moment)
                ->where('to', '>=', $moment)
                ->firstOrFail();
        } else {
            if ($data['delivery'] - 30 < $moment) {
                throw new OpeningHourExceededException();
            }
            OpeningHour::where('n', Carbon::now()->dayOfWeek)
                ->where('from', '<=', $data['delivery'])
                ->where('to', '>=', $data['delivery'])
                ->firstOrFail();
        }

        try {
            DB::beginTransaction();

            // Benutzer speichern oder Patchen
            $user = User::firstOrNew(
                [
                    'email' => $data['email'],
                ],
                [
                    'role' => User::CUSTOMER_ROLE,
                ]
            );
            $user->save();

            // method
            $method = Method::findOrFail($data['method_id']);
            if (!$method->active) {
                throw new ValidationException($validator);
            }

            // neue Bestellung
            $order = new Order([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'street' => $data['street'],
                'floor' => $data['floor'],
                'notes' => $data['notes'],
                'delivery' => $data['delivery'],
                'state' => $method->id != Method::METHOD_ID_PAYPAL ? Order::STATE_NEW : Order::STATE_PENDING_PAYMENT,
                'ip' => $request->ip()]);
            $order->user()->associate($user);
            $order->method()->associate($method);
            $postcode = Postcode::findOrFail($data['location']['postcode_id']);
            $order->postcode()->associate($postcode);
            $order->save();

            // Iterieren durch Bestellung
            $cart = $data['cart'];
            foreach ($cart as $position) {
                // neues Model
                $positionModel = new Position(['quantity' => $position['quantity']]);
                // Variante raussuchen
                $variant = Variant::findOrfail($position['variant_id'])->load('extraGroup');
                // Artikel speichern auf Bestellung
                $positionModel->order()->associate($order);
                $positionModel->variant()->associate($variant);
                $positionModel->save();
                foreach ($position['extras'] as $extraId) {
                    $extra = Extra::findOrFail($extraId['id']);
                    if ($extra->extraGroup()->getResults()->id != $variant->extraGroup()->getResults()->id) {
                        throw new ExtraGroupNotValidException('Extra passt nicht zur Variante');
                    }
                    $extra->positions()->attach($positionModel);
                }
            }

            // mindestbestellwert check
            $rate = $postcode->region()->first()->rates()->where('minimum', '<=', $order->subtotal)->orderByDesc('minimum')->first();
            if ($rate == null) {
                throw new RateNotFoundException('Mindestbestellwert nicht erreicht');
            } else {
                $order->rate()->associate($rate);
                $order->save();
            }

            DB::commit();

            // Email senden
            if ($method->id != Method::METHOD_ID_PAYPAL) {
                Mail::to($user->email)->send(new OrderCreated($order));
                return response()->json(true, 200);
            }

            // If Paypal dann Paymentlink generieren
            $provider = PayPal::setProvider();
            $provider->getAccessToken();
            $resp = $provider->createOrder(number_format($order->total / 100, 2, '.', ''), URL::to('/') . '/checkout/paypal', URL::to('/') . '/cart', '1');
            if ($resp['status'] != 'CREATED') {
                throw new PayPalException();
            }
            $order->paypal_payment_id = $resp['id'];
            $order->save();
            return response($resp['links'][1]['href'], 200);

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

}
