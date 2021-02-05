<?php

namespace App\Http\Controllers;

use App\Mail\ReportExport;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cookies', 'auth', 'can:show-report'], ['only' => [
            'store',
        ]]);
    }

    /**
     * Erstelle einen neuen Bericht und sende Email
     */
    public function update(Request $request, $id)
    {
        $reportRules = array(
            'dateFrom' => 'required|numeric',
            'dateTo' => 'required|numeric',
            'email' => 'email|required',
        );
        $data = $request->data;
        $validator = Validator::make($data, $reportRules);
        if ($validator->fails()) {
            throw new ValidationException();
        }

        $dateFrom = Carbon::createFromTimestampMs($data['dateFrom']);
        $dateTo = Carbon::createFromTimestampMs($data['dateTo']);
        $email = $data['email'];

        $orders = Order::where('created_at', '>', $dateFrom)
            ->where('created_at', '<=', $dateTo)
            ->with(
                [
                    'method',
                    'user',
                    'rate',
                    'refundRate',
                    'postcode' => function ($query) {
                        $query->with('region');
                        $query->with('cities');
                    },
                    'positions' => function ($query) {
                        $query->with(['variant' => function ($query) {
                            $query->with('food');
                            $query->with('variations');
                        }]);
                        $query->with('extras');
                    }])->get();

        $arr = [[
            "Erstellt",
            "Bearbeitet",
            "Rechnungsnummer",
            "Zahlungsart",
            "Email",
            "Name",
            "Telefon",
            "Straße",
            "Etage",
            "Referenz Rechnungsnummer",
            "Postleitzahl",
            "Stadt",
            "Status",
            "Netto Zwischensumme",
            "Mehrwertsteuer",
            "Lieferkosten",
            "Zurückerstattung Lieferkosten",
            "Gesamt"],

        ];

        foreach ($orders as $order) {
            array_push($arr, [
                $order->created_at,
                $order->updated_at,
                $order->id,
                $order->method->name,
                $order->user->email,
                $order->name,
                $order->phone,
                $order->street,
                $order->floor,
                $order->reference_order_id,
                $order->postcode->postcode,
                $order->postcode->cities[0]->name,
                $order->state,
                $order->netSubtotal / 100,
                $order->taxSubtotal / 100,
                $order->rate ? $order->rate->costs / 100 : 0,
                $order->refundRate ? $order->refundRate->costs * (-1) / 100 : 0,
                $order->total / 100]);
        }

        $fp = fopen('php://temp', 'r+b');
        foreach ($arr as $input) {
            fputcsv($fp, $input);
        }
        rewind($fp);
        $csvfile = rtrim(stream_get_contents($fp), "\n");
        fclose($fp);

        // Email senden
        Mail::to($email)->send(new ReportExport($csvfile));
        return response()->json(true);
    }

}
