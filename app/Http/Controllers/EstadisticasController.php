<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Automoviles;
use App\Models\Multas;
use App\Models\verificacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function index()
    {
        // Obtener los costos de mantenimiento por automóvil
        $costos = Servicios::select(
                'automoviles.id_automovil', 
                'automoviles.marca', 
                'automoviles.submarca', 
                'automoviles.modelo', 
                DB::raw('SUM(servicios.costo) as total_costo')
            ) 
            ->join('automoviles', 'servicios.id_automovil', '=', 'automoviles.id_automovil') 
            ->groupBy('automoviles.id_automovil', 'automoviles.marca', 'automoviles.submarca', 'automoviles.modelo')
            ->get();

        // Obtener el número de multas por tipo
        $multasPorTipo = Multas::select('tipo_multa', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('tipo_multa')
        ->get();

        // Calcular el kilometraje total o promedio
        $kilometrajePorVehiculo = Automoviles::select('id_automovil', 'marca', 'modelo', DB::raw('SUM(kilometraje) as total_kilometraje'))
        ->groupBy('id_automovil', 'marca', 'modelo')
        ->get();

        return view('modulos.estadisticas.index', compact('costos', 'multasPorTipo', 'kilometrajePorVehiculo'));

    }


public function descargarReporte($idAutomovil)
{
    // Obtener el vehículo específico con sus relaciones
    $vehiculo = Automoviles::with(['multas', 'servicios', 'verificacion'])->find($idAutomovil);

    // En caso de que el vehículo no exista
    if (!$vehiculo) {
        abort(404, 'Vehículo no encontrado');
    }

    // Sumatoria
    $totalMultas = $vehiculo->multas->sum('monto');
    $totalServicios = $vehiculo->servicios->sum('costo');

    // Generar el PDF a partir de la vista, pasando los totales
    $pdf = Pdf::loadView('modulos.estadisticas.pdf', compact('vehiculo', 'totalMultas', 'totalServicios'));

    // PDF con un nombre descriptivo
    return $pdf->stream('reporte_vehiculo_' . $vehiculo->marca . '.pdf');
}
}