<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use App\Models\Automoviles;
use Illuminate\Http\Request;

class GestionController extends Controller
{

    public function index()
    {
        $disponibilidad = asignacion::select('id_automovil','estatus')->get();
        return view('modulos.Gestion.index',compact('disponibilidad'));
    }




    public function show(string $id)
    {
        //
    }

}
