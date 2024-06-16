<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AreaController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('salas', SalaController::class);
Route::apiResource('reservas', ReservaController::class);
Route::apiResource('areas', AreaController::class);

// Nueva ruta para obtener reservas por sala y fecha
Route::get('reservas/{sala}/{fecha}', [ReservaController::class, 'getReservasBySalaFecha']);

Route::get('/routes', function () {
    $routes = collect(\Illuminate\Support\Facades\Route::getRoutes())->map(function ($route) {
        return [
            'methods' => $route->methods(),
            'uri' => $route->uri(),
            'name' => $route->getName(),
            'action' => $route->getActionName(),
            'middleware' => $route->middleware(),
        ];
    });
    return response()->json($routes);
});

Route::get('reservas-por-fecha', [ReservaController::class, 'getReservasGroupedByFecha']);
