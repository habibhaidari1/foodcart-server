<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'postcode',
    ];

    protected $casts = [
        'region_id' => 'integer',
    ];


    public function cities()
    {
        return $this->belongsToMany('App\City');
    }

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

}
