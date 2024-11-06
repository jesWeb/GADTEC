<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VigilanteController extends Controller
{
    // Mostrar la bitácora de asignaciones
    public function index()
    {
        // Datos simulados de asignaciones
        $asignaciones = [
            [
                'vehiculo' => 'Toyota Corolla',
                'usuario' => 'Juan Pérez',
                'fecha_asignacion' => '2024-10-30',
                'fecha_estimacion_dev' => '2024-11-02',
                'fecha_llegada' => '2024-10-30',
                'destino' => 'Oficina Central',
                'motivo' => 'Reunión',
                'km_salida' => 10,
                'combustible_salida' => 50,
                'hora_salida' => '08:00',
                'km_llegada' => 20,
                'combustible_llegada' => 30,
                'hora_llegada' => '10:00',
            ],
            // Agrega más registros simulados según necesites
            [
                'vehiculo' => 'Honda Civic',
                'usuario' => 'Ana Gómez',
                'fecha_asignacion' => '2024-10-29',
                'fecha_estimacion_dev' => '2024-11-01',
                'fecha_llegada' => '2024-10-29',
                'destino' => 'Sucursal Norte',
                'motivo' => 'Visita a Cliente',
                'km_salida' => 15,
                'combustible_salida' => 45,
                'hora_salida' => '09:00',
                'km_llegada' => 25,
                'combustible_llegada' => 35,
                'hora_llegada' => '11:00',
            ],
        ];

        return view('vigilante.index', compact('asignaciones'));
    }
}
