<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    public $timestamps = false;

    protected $fillable = ['quantity'];

    protected $hidden = [
        'order_id', 'variant_id', 'id',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Nettopreis
     */
    public function getNetTotalAttribute()
    {
        return $this->total / ((100 + $this->variant->tax_rate) / 100);
    }

    /**
     * Steuern
     */
    public function getTaxTotalAttribute()
    {
        return $this->total - $this->netTotal;
    }

    /**
     * Preis der Variante + Extras in Brutto
     */
    public function getPriceAttribute()
    {
        return ($this->variant->price + $this->extras->pluck('price')->sum());
    }

    /**
     * Anzahl * Preis (Brutto)
     */
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function variant()
    {
        return $this->belongsTo('App\Variant');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function extras()
    {
        return $this->belongsToMany('App\Extra');
    }

}
