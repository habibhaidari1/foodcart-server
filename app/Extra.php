<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'pivot', 'extra_group_id'];

    protected $fillable = ['price', 'name'];

    protected $casts = ['price' => 'integer'];

    public function extraGroup()
    {
        return $this->belongsTo('App\ExtraGroup');
    }

    public function positions()
    {
        return $this->belongsToMany('App\Position');
    }

}
