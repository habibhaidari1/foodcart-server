<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaravelFillableRelations\Eloquent\Concerns\HasFillableRelations;

class Category extends Model
{
    use HasFillableRelations;

    const CATEGORY_TYPE_LIST = 'LIST';    
    const CATEGORY_TYPE_CARDS = 'CARDS';

    protected $fillable_relations = ['food'];

    protected $fillable = [
        'name', 'description', 'image', 'sorting', 'type',
    ];

    protected $hidden = [
        'sorting', 'created_at', 'updated_at',
    ];

    public function food()
    {
        return $this->belongsToMany('App\Food');
    }

    // TODO Hässliche Funktion
    public function bulkAttachFood(array $array)
    {
        foreach ($array as $model) {
            $model = Food::create($model);
            $this->food()->attach($model);
        }
    }

}
