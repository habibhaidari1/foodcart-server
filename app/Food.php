<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;

class Food extends Model
{
    use SoftDeletes;
    use HasFillableRelations;

    protected $fillable_relations = ['variants', 'variationGroups', 'categories'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['name', 'description', 'number', 'image'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function variants()
    {
        return $this->hasMany('App\Variant');
    }

    public function variationGroups()
    {
        return $this->belongsToMany('App\VariationGroup');
    }

}
