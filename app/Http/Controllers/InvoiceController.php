<?php

namespace App\Http\Controllers;

use App\Meta;
use App\Order;
use PDF;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cookies', 'auth', 'can:show-invoice'], ['only' => ['show',
        ]]);
    }

    /**
     * Zeige Bestellungen ab einem bestimmten Zeitstempel
     */
    public function show($id)
    {
        $meta = Meta::all()->pluck('value', 'name');
        $order = Order::find($id);
        $pdf = PDF::loadView('pdf.invoice', ['order' => $order, 'meta' => $meta]);
        return $pdf->stream('Rechnung_' . $order->id . '_' . $order->created_at->format('d_m_Y') . '.pdf');
    }

}
