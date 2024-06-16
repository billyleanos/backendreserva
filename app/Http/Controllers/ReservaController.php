<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Sala;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        return Reserva::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'id_sala' => 'required|integer|exists:salas,id_sala',
            'id_area' => 'required|integer|exists:areas,id_area',
            'fecha_reserva' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s',
            'evento' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);

        $reserva = Reserva::create($request->all());

        return response()->json($reserva, 201);
    }

    public function show($id)
    {
        $reserva = Reserva::find($id);
        if (is_null($reserva)) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }
        return response()->json($reserva);
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::find($id);
        if (is_null($reserva)) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $request->validate([
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'id_sala' => 'required|integer|exists:salas,id_sala',
            'id_area' => 'required|integer|exists:areas,id_area',
            'fecha_reserva' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s',
            'evento' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);

        $reserva->update($request->all());

        return response()->json($reserva);
    }

    public function destroy($id)
    {
        $reserva = Reserva::find($id);
        if (is_null($reserva)) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }
        $reserva->delete();
        return response()->json(null, 204);
    }

    // Método para obtener reservas por sala y fecha
    public function getReservasBySalaFecha($sala, $fecha)
    {
        // Obtener la sala por nombre
        $sala = Sala::where('nombre_sala', $sala)->first();

        if (is_null($sala)) {
            return response()->json(['message' => 'Sala no encontrada'], 404);
        }

        // Obtener las reservas por sala y fecha
        $reservas = Reserva::where('id_sala', $sala->id_sala)
                            ->where('fecha_reserva', $fecha)
                            ->with('usuario') // Incluye el usuario relacionado
                            ->get();

        $result = $reservas->map(function($reserva) {
            return [
                'hora_inicio' => $reserva->hora_inicio,
                'hora_fin' => $reserva->hora_fin,
                'nombre_usuario' => $reserva->usuario->nombre_apellido,
                'evento' => $reserva->evento,
                'duracion' => $this->calculateDuration($reserva->hora_inicio, $reserva->hora_fin),
            ];
        });

        return response()->json($result);
    }

    private function calculateDuration($hora_inicio, $hora_fin)
    {
        $inicio = new \DateTime($hora_inicio);
        $fin = new \DateTime($hora_fin);
        $interval = $inicio->diff($fin);

        return $interval->format('%h horas %i minutos');
    }

    // Método para listar todas las reservas agrupadas por fecha
    public function getReservasGroupedByFecha()
    {
        // Obtener todas las reservas, incluidas las relaciones necesarias
        $reservas = Reserva::with('usuario')->get();

        // Agrupar las reservas por fecha
        $grouped = $reservas->groupBy('fecha_reserva');

        // Formatear la respuesta
        $result = [];
        foreach ($grouped as $fecha => $reservasPorFecha) {
            $result[$fecha] = $reservasPorFecha->map(function($reserva) {
                return [
                    'title' => $reserva->evento,
                    'description' => "Reserva realizada por " . $reserva->usuario->nombre_apellido . " desde " . $reserva->hora_inicio . " hasta " . $reserva->hora_fin,
                    'hora_inicio' => $reserva->hora_inicio,
                    'hora_fin' => $reserva->hora_fin
                ];
            });
        }

        return response()->json(['reservas' => $result]);
    }
}

