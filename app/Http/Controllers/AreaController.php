<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        return Area::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_area' => 'required|string|max:50',
        ]);

        $area = Area::create($request->all());

        return response()->json($area, 201);
    }

    public function show($id)
    {
        $area = Area::find($id);
        if (is_null($area)) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }
        return response()->json($area);
    }

    public function update(Request $request, $id)
    {
        $area = Area::find($id);
        if (is_null($area)) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }

        $request->validate([
            'nombre_area' => 'required|string|max:50',
        ]);

        $area->update($request->all());

        return response()->json($area);
    }

    public function destroy($id)
    {
        $area = Area::find($id);
        if (is_null($area)) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }
        $area->delete();
        return response()->json(null, 204);
    }
}


