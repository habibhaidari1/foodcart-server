<?php

namespace App\Http\Controllers;

use App\Meta;
use App\Method;
use App\OpeningHour;

class RestaurantController extends Controller
{

    public function __construct()
    {

        $this->middleware(['cache.headers:public;max_age=0;etag'], ['only' => [
            'index',
        ]]);
    }

    /**
     * Gibt eager alle Informationen für den Client
     */
    public function index()
    {
        return response()->json(
            [
                'informations' => Meta::all()->pluck('value', 'name'),
                'opening_hours' => OpeningHour::orderBy('from')->get()->groupBy('n'),
                'methods' => Method::where('active', '=', true)->get(),
            ]
        );
    }

}
