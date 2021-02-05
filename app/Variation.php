<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    protected $casts = ['variation_group_id' => 'integer'];

    public function variationGroup()
    {
        return $this->hasOne('App\VariationGroup');
    }
    public function variants()
    {
        return $this->belongsToMany('App\Variant');
    }
}
