<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;

class Variant extends Model
{
    use SoftDeletes;
    use HasFillableRelations;

    protected $fillable_relations = ['variations'];

    protected $fillable = ['price', 'tax_rate', 'default'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'tax_rate'];

    protected $casts = ['default' => 'boolean', 'price' => 'integer', 'tax_rate' => 'integer', 'food_id' => 'integer', 'extra_group_id' => 'integer'];


    public function variations()
    {
        return $this->belongsToMany('App\Variation');
    }
    
    public function food()
    {
        return $this->belongsTo('App\Food');
    }

    public function positions()
    {
        return $this->hasMany('App\Position');
    }

    public function extraGroup()
    {
        return $this->belongsTo('App\ExtraGroup');
    }
}
