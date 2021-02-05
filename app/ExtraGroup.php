<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraGroup extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function extras()
    {
        return $this->hasMany('App\Extra');
    }

    public function variants()
    {
        return $this->hasMany('App\Variant');
    }
}
