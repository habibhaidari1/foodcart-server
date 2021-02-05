<?php

namespace App\Mail;

use App\Meta;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class OrderCanceled extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $meta;
    private $invoice;

    public $subject = 'Deine Bestellung wurde storniert';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->meta = Meta::all()->pluck('value', 'name');
        $this->order = $order;
        $this->invoice = PDF::loadView('pdf.invoice', ['meta' => $this->meta, 'order' => $this->order]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.order_canceled', ['meta' => $this->meta])
            ->attachData($this->invoice->output(), 'Rechnung_' . $this->order->id . '_' . $this->order->created_at->format('d_m_Y') . '.pdf', ['mime' => 'application/pdf']);
    }
}
