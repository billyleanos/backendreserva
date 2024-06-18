<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|string|email',
            // 'password' => 'required|string', // Eliminado ya que no se usará para la autenticación
        ]);

        // Buscando al usuario por correo
        $usuario = Usuario::where('correo', $request->correo)->first();

        // Verificar que el usuario existe
        if ($usuario) {
            // Si el usuario existe, devolver los detalles del usuario
            return response()->json([
                'id_usuario' => $usuario->id_usuario,
                'nombre_apellido' => $usuario->nombre_apellido,
                'correo' => $usuario->correo,
                'telefono' => $usuario->telefono,
                'estado' => $usuario->estado,
            ]);
        }

        // Si el usuario no existe, devolver un mensaje de error
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
}
