<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:50',
            'correo' => 'required|string|email|max:100|unique:usuarios',
            'password' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);

        $usuario = Usuario::create([
            'nombre_apellido' => $request->nombre_apellido,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'estado' => $request->estado,
        ]);

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (is_null($usuario)) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (is_null($usuario)) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'nombre_apellido' => 'required|string|max:50',
            'correo' => 'required|string|email|max:100|unique:usuarios,correo,'.$usuario->id_usuario.',id_usuario',
            'password' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);

        $usuario->update([
            'nombre_apellido' => $request->nombre_apellido,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'estado' => $request->estado,
        ]);

        return response()->json($usuario);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if (is_null($usuario)) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $usuario->delete();
        return response()->json(null, 204);
    }
}
