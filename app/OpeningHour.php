<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['n', 'from', 'to'];

    protected $casts = ['n' => 'integer', 'from' => 'integer', 'to' => 'integer'];

}
