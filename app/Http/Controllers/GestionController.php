<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Multas;
use App\Models\asignacion;
use App\Models\Automoviles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GestionController extends Controller
{

    public function __construct() {
        $this->middleware('auth:usuarios');
    }

    public function index()
    {
        // $disponibilidad = asignacion::with('automovil')
        //     ->get();
        $disponibilidad = Automoviles::with('asignacion')->get();

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


    public function update($id, Request $request)
    {
        $query = asignacion::find($id);
            $query->estatus = 'Autorizado';
        $query -> save();
        
        $disponibilidad = Automoviles::with('asignacion')->get();
        return view('modulos.Gestion.index', compact('disponibilidad'));
    }
    // public function usu_salvar(UsuariosModel $id, Request $request){
    //     //dd($id);
    //     $id->update(
    //             //$request->all();
    //             $request->only('nombre','ap_paterno','ap_materno','correo','pass')
    //         );
    //     return redirect()->route("usu_detalle", ['id' => $id->id]);
    // }

}
