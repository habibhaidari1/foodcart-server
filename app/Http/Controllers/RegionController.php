<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cookies', 'auth', 'can:update-region'], ['only' => [
            'store', 'destroy', 'index', 'show',
        ]]);
    }

    /**
     * Eine Region mit allen Daten auslesen
     */
    public function show($region)
    {
        return response()->json(Region::with(['rates', 'postcodes'])->find($region));
    }

    /**
     * Regionen mit Postleitzahlen für Admin
     */
    public function index()
    {
        return response()->json(Region::with('postcodes')->get());
    }

    /**
     * Region löschen mit allen Daten darin
     */
    public function destroy($region)
    {
        $region = Region::find($region);
        $region->postcodes()->update(['region_id' => null]);
        $region->rates()->detach();
        return response()->json($region->delete());
    }

    /**
     * Neue Region generieren
     */
    public function store(Request $request)
    {
        $region = new Region();
        $region->save();
        // todo dreckig
        return response()->json(Region::with(['postcodes', 'rates'])->find($region->id));
    }

}
