<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    public static $protectedMetas = ['name', 'representative', 'street', 'city', 'country', 'vat_id', 'authority', 'description', 'closed'];

    protected $hidden = ['id'];

    public $timestamps = false;

    protected $fillable = [
        'name', 'value',
    ];

    public function getValueAttribute($value)
    {
        if ($this->name == "closed") {
            return boolVal($value);
        }
        return $value;
    }

}
