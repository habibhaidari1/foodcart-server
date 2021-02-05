<?php

namespace App\Http\Controllers;

use App\Category;
use App\ExtraGroup;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cache.headers:public;max_age=0;etag'], ['only' => [
            'index',
        ]]);
    }

    /**
     * Gibt das Menü des Restaurants zurück
     */
    public function index()
    {
        return response()->json(
            ["categories" => Category::with(['food.variants.variations', 'food.variationGroups.variations', 'food' => function ($query) {
                $query->with('variants');
            }], 'food.variationGroups')->orderBy('sorting')->get(),
                "extra_groups" => ExtraGroup::whereHas('variants')->with('extras')->get(),
            ]);

    }

}
