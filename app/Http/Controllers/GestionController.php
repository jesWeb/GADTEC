<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use App\Models\Automoviles;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GestionController extends Controller
{

    public function index()
    {
        $disponibilidad = asignacion::with('automovil')
            ->get();
        // dd($disponibilidad);
        return view('modulos.Gestion.index', compact('disponibilidad'));
    }

    public function show(string $id)
    {
        $dispo = asignacion::with('automovil')
            ->where('id_asignacion', $id)
            ->get();
        return view('modulos.Gestion.show', compact('dispo',));
    }
}
