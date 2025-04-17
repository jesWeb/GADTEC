<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignacionController;
use App\Models\asignacion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::get('/vehiculos/{id}/horarios', function ($id) {
    try {
        $reservaciones = asignacion::where('id_automovil', $id)
            ->whereIn('estatus', ['Reservado', 'Autorizado', 'Ocupado'])
            ->get(['fecha_salida', 'hora_salida']);

        $bloqueos = $reservaciones->map(function ($res) {
            $inicio = $res->fecha_salida . ' ' . $res->hora_salida;

            $timestampInicio = strtotime($inicio) - (60 * 60);  // Restar 1 hora
            $timestampFin = $timestampInicio + (3 * 60 * 60); // 2 horas de duración + 1 hora antes

            return [
                'from' => date('Y-m-d H:i', $timestampInicio),
                'to'   => date('Y-m-d H:i', $timestampFin),
            ];
        });

        return response()->json($bloqueos);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Ocurrió un problema al obtener los horarios. Inténtalo más tarde.'
        ], 500);
    }
});
