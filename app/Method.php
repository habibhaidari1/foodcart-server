<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{

    const METHOD_ID_CASH = 1;
    const METHOD_ID_CARD = 2;
    const METHOD_ID_PAYPAL = 3;


    protected $fillable = ['name', 'default'];

    protected $hidden = ['active'];

    protected $casts = ['default' => 'boolean', 'active' => 'boolean'];

    public $timestamps = false;

}
