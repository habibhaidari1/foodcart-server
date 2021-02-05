<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidOpeningHourException;
use App\OpeningHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OpeningHourController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cookies', 'auth', 'can:update-openingHour'], ['only' => [
            'store', 'destroy', 'index',
        ]]);

    }

    /**
     * alle Öffnungszeiten sortieren und anzeigen
     */
    public function index()
    {
        return response()->json(
            OpeningHour::
                orderBy('n', 'asc')
                ->orderBy('from', 'asc')
                ->get()
                ->makeVisible(['id', 'created_at', 'updated_at']));
    }

    /**
     * Neue Öffnungszeit speichern
     */
    public function store(Request $request)
    {
        $openingHourRules = array(
            'n' => 'integer|required|min:0|max:6',
            'from' => 'integer|required|min:0',
            'to' => 'integer|required|max:1440',
        );

        $data = $request->data;
        $validator = Validator::make($data, $openingHourRules);
        if ($validator->fails()) {
            throw new ValidationException();
        }

        if ($data['from'] >= $data['to']) {
            throw new InvalidOpeningHourException();
        }

        // Prüfen ob sich was überschneidet
        if (OpeningHour::where('n', $data['n'])
            ->where('from', '<=', $data['from'])
            ->where('to', '>=', $data['from'])
            ->exists() ||
            OpeningHour::where('n', $data['n'])
            ->where('from', '<=', $data['to'])
            ->where('to', '>=', $data['to'])
            ->exists() ||
            OpeningHour::where('n', $data['n'])
            ->where('from', '<=', $data['from'])
            ->where('to', '>=', $data['to'])
            ->exists() ||
            OpeningHour::where('n', $data['n'])
            ->where('from', '>=', $data['from'])
            ->where('to', '<=', $data['to'])
            ->exists()
        ) {
            throw new InvalidOpeningHourException();
        }

        $openingHour = new OpeningHour([
            'n' => $data['n'],
            'from' => $data['from'],
            'to' => $data['to'],
        ]);
        $openingHour->save();
        return response()->json($openingHour->makeVisible(['id']));
    }

    /**
     * Öffnungszeit löschen
     */
    public function destroy($opening)
    {
        return response()->json(OpeningHour::find($opening)->delete());
    }

}
