<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

    protected $hidden = ['pivot'];

    public $timestamps = false;

    public function postcodes()
    {
        return $this->belongsToMany('App\Postcode');
    }
}
