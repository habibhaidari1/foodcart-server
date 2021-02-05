<?php

namespace App\Http\Controllers;

use App\Exceptions\PayPalException;
use App\Mail\OrderCreated;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PayPal;

class PayPalController extends Controller
{
    public function captureOrder(Request $req)
    {
        if (!$req->has(['token', 'PayerID'])) {
            throw new PayPalException();
        }
        $token = $req->token;
        
        $order = Order::where('paypal_payment_id', '=', $token)->firstOrFail();

        if ($order->state != Order::STATE_PENDING_PAYMENT) {
            return response()->json(true, 201);
        }

        $provider = PayPal::setProvider();
        $provider->getAccessToken();
        $resp = $provider->captureOrder($token);
        // purchase_units, payments, captures, 0, id
        $status = $resp['status'];
        $payer_id_paypal = $resp['payer']['payer_id'];
        if ($status != 'COMPLETED') {
            throw new PayPalException();
        }
        $order->paypal_payer_id = $payer_id_paypal;
        $order->paypal_capture_id = $resp['purchase_units'][0]['payments']['captures'][0]['id'];
        $order->state = Order::STATE_NEW;
        $order->save();

        // Email schicken
        Mail::to($order->user->email)->send(new OrderCreated($order));

        return response()->json(true);
    }

}
