<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{

    use SoftDeletes;

    public $timestamps = false;

    protected $casts = ['minimum' => 'integer', 'costs' => 'integer'];

    protected $hidden = ['pivot', 'deleted_at'];

    protected $fillable = ['minimum', 'costs'];

    // TODO KONZEPTFEHLER Eine Rate kann nur zu einer Region gehören
    public function regions()
    {
        return $this->belongsToMany('App\Region');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');

    }
}
