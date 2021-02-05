<?php

namespace App\Http\Controllers;

use App\Postcode;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class PostcodeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cookies', 'auth', 'can:update-postcode'], ['only' => [
            'store', 'destroy',
        ]]);
    }

    /**
     * Suche nach Postleitzahlen
     */
    public function show($postcode)
    {
        return DB::table('postcodes')
            ->where('postcodes.postcode', 'LIKE', $postcode . '%')
            ->join('city_postcode', 'city_postcode.postcode_id', '=', 'postcodes.id')
            ->join('cities', 'city_postcode.city_id', '=', 'cities.id')->get();
    }

    /**
     * Zuordenen von Postleitzahlen zu einer Region
     */
    public function store(Request $request)
    {
        $postcodeRules = array(
            'postcode' => 'required|exists:postcodes,postcode',
            'region_id' => 'required|exists:regions,id',
        );

        $data = $request->data;
        $validator = Validator::make($data, $postcodeRules);
        if ($validator->fails()) {
            throw new ValidationException();
        }

        $region = Region::find($data['region_id']);
        $postcode = Postcode::where('postcode', $data['postcode'])->first();
        $postcode->region()->associate($region)->save();

        return response()->json($postcode);
    }

    /**
     * Trennen von Postleitzahlen zu einer Region
     */
    public function destroy($identifier)
    {
        $postcode = Postcode::where('postcode', $identifier)->first();
        return response()->json($postcode->region()->dissociate()->save());
    }

}
