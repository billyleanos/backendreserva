<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Buscando al usuario por correo
        $usuario = Usuario::where('correo', $request->correo)->first();

        // Verificar que el usuario existe y que la contraseña coincide
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Si la autenticación es exitosa, devolver los detalles del usuario
            return response()->json([
                'id_usuario' => $usuario->id_usuario,
                'nombre_apellido' => $usuario->nombre_apellido,
                'correo' => $usuario->correo,
                'telefono' => $usuario->telefono,
                'estado' => $usuario->estado,
            ]);
        }

        // Si la autenticación falla, devolver un mensaje de error
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
}
