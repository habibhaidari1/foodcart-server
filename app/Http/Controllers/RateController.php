<?php

namespace App\Http\Controllers;

use App\Postcode;
use App\Rate;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RateController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cache.headers:public;max_age=0;etag'], ['only' => [
            'show', 'store', 'destroy',
        ]]);

        $this->middleware(['cookies', 'auth', 'can:update-rate'], ['only' => [
            'store', 'destroy',
        ]]);

    }

    /**
     * Speichern neue Mindestpreis/ Lieferkostenkombinationen
     */
    public function store(Request $request)
    {

        $rateRules = array(
            'minimum' => 'integer|required',
            'costs' => 'integer|required',
            'region_id' => 'required|exists:regions,id',
        );

        $data = $request->data;
        $validator = Validator::make($data, $rateRules);
        if ($validator->fails()) {
            throw new ValidationException();
        }
        $region = Region::find($data['region_id']);
        $rate = Rate::create(['costs' => $data['costs'], 'minimum' => $data['minimum']]);
        $region->rates()->attach($rate);

        return response()->json($rate);
    }

    /**
     * Zeigt die Rates zu einer Postleitzahl an
     */
    public function show($postcode)
    { // KORRIGIERTE SORTIERUNG
        // TODO ZU HÄSSLICH
        $postcode = Postcode::where('postcode', $postcode)->first();
        if ($postcode) {
            $region = $postcode->region()->first();
            if ($region) {
                return response()->json($region->rates()->orderBy('minimum')->get());
            }
        }
        return response()->json(array());
    }

    /**
     * Löscht eine Rate
     */
    public function destroy($id)
    {
        $rate = Rate::find($id);
        $rate->regions()->detach();
        return response()->json(true);
    }

}
