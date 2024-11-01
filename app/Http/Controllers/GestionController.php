<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Multas;
use App\Models\asignacion;
use App\Models\Automoviles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GestionController extends Controller
{


    public function index()
    {
        // Obtener la disponibilidad de automóviles
       
        $disponibilidad = Asignacion::with('automovil')->get();

        // Pasar ambas variables a la vista
        return view('modulos.Gestion.index', compact('disponibilidad'));
    }


}
