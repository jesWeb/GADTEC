<?php
namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Automoviles;
use App\Models\Multas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function index() {
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


       // Obtener multas por año utilizando el modelo Multas
       $multasPorAnio = Multas::select(DB::raw('YEAR(fecha_multa) as anio'), DB::raw('SUM(monto) as total_monto'))
       ->groupBy('anio') // Agrupamos por el alias 'anio'
       ->orderBy('anio', 'asc') // Ordenamos por año ascendente
       ->get();

        // Asegúrate de que estás pasando la variable correctamente
        return view('modulos.estadisticas.index', compact('costos', 'multasPorAnio'));
    
    
    
    }
}
