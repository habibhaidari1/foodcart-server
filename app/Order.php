<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{

    const STATE_NEW = 'NEW';
    const STATE_PENDING_PAYMENT = 'PENDING_PAYMENT';
    const STATE_PROCESSING = 'PROCESSING';
    const STATE_DELIVERING = 'DELIVERING';
    const STATE_CANCELED = 'CANCELED';
    const STATE_CLOSED = 'CLOSED';

    protected $fillable = [
        'notes', 'delivery', 'name', 'street', 'floor', 'phone', 'ip', 'rate', 'state', 'paypal_payment_id', 'paypal_payer_id'
    ];

    // steuer ohne Lieferkosten
    public function getSubtotalAttribute()
    {
        return $this->positions->pluck('total')->sum();
    }

    // steuer mit Lieferkosten
    public function getTotalAttribute()
    {
        $total = $this->subtotal;
        $total += $this->rate ? $this->rate->costs : 0;
        $total -= $this->refundRate ? $this->refundRate->costs : 0;
        return $total;
    }


    // ohne steuern ohne lieferkosten
    public function getNetSubtotalAttribute()
    {
        return $this->positions->pluck('netTotal')->sum();
    }

    public function getTaxSubtotalAttribute()
    {
        return $this->getSubtotalAttribute() - $this->getNetSubtotalAttribute();
    }

    public function refundRate()
    {
        return $this->belongsTo('App\Rate');
    }

    public function rate()
    {
        return $this->belongsTo('App\Rate');
    }

    public function method()
    {
        return $this->belongsTo('App\Method');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function positions()
    {
        return $this
            ->hasMany('App\Position');
    }

    public function referenceOrder()
    {
        return $this->BelongsTo('App\Order');
    }

    public function postcode()
    {
        return $this->BelongsTo('App\Postcode');
    }

}
