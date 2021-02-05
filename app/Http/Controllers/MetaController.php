<?php

namespace App\Http\Controllers;

use App\Meta;
use Illuminate\Http\Request;
use App\Exceptions\ProtectedMetaException;


class MetaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['cookies', 'auth', 'can:update-meta'], ['only' => [
            'update', 'destroy', 'store', 
        ]]);

    }

    /**
     * Liste mit allen Metas zum Restaurant
     */
    public function index()
    {
        return response()->json(
            Meta::all()
        );
    }

    /**
     * Meta löschen
     */
    public function destroy($name)
    {
        if(in_array($name,Meta::$protectedMetas)){
            throw new ProtectedMetaException('Dieser Wert kann darf nicht leer sein');
        }
        return response()->json(Meta::where('name', '=', $name)->firstOrFail()->delete());
    }

    /**
     * Meta speichern
     */
    public function store(Request $request)
    {
        $data = $request->data;
        $meta = Meta::create(
            ['name' => $data['name']],
            ['value' => $data['value']]
        );
        return response()->json($meta);
    }

    /**
     * Meta überschreiben // TODO WAS SOLL UPDATE ZURÜCKGEBEN? BOOLEAN ODER MEHR
     */
    public function update(Request $request, $name)
    {
        $data = $request->data;
        Meta::updateOrCreate(
            ['name' => $name],
            ['value' => $data['value']]
        );
        return response()->json(true);
    }

}
