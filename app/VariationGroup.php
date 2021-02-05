<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;

class VariationGroup extends Model
{

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    use HasFillableRelations;

    protected $fillable_relations = ['variations'];

    public function food()
    {
        return $this->belongsToMany('App\Food');
    }

    public function variations()
    {
        return $this->hasMany('App\Variation');
    }

}
