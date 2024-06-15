<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index()
    {
        return Sala::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_sala' => 'required|string|max:50',
            'capacidad' => 'required|integer',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $sala = Sala::create($request->all());

        return response()->json($sala, 201);
    }

    public function show($id)
    {
        $sala = Sala::find($id);
        if (is_null($sala)) {
            return response()->json(['message' => 'Sala no encontrada'], 404);
        }
        return response()->json($sala);
    }

    public function update(Request $request, $id)
    {
        $sala = Sala::find($id);
        if (is_null($sala)) {
            return response()->json(['message' => 'Sala no encontrada'], 404);
        }

        $request->validate([
            'nombre_sala' => 'required|string|max:50',
            'capacidad' => 'required|integer',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $sala->update($request->all());

        return response()->json($sala);
    }

    public function destroy($id)
    {
        $sala = Sala::find($id);
        if (is_null($sala)) {
            return response()->json(['message' => 'Sala no encontrada'], 404);
        }
        $sala->delete();
        return response()->json(null, 204);
    }
}
