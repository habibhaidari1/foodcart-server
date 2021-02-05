<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $timestamps = false;

    public function postcodes()
    {
        return $this->hasMany('App\Postcode');
    }

    public function rates()
    {
        return $this->belongsToMany('App\Rate');
    }
}
