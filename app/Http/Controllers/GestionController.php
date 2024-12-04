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
        // $disponibilidad = \DB::select("SELECT * 
        // FROM automoviles AS aut
        // JOIN asignacions AS asi
        // ON aut.id_automovil = asi.id_automovil
        // WHERE asi.estatus IS NOT NULL 
        // GROUP BY aut.id_automovil;");

        $disponibilidad = DB::select("
        SELECT 
            aut.*, 
            asi.id_asignacion, 
            asi.estatus AS estatus_asignacion,
            aut.estatusIn,
            -- Lógica para determinar el estatus final
            CASE
                WHEN asi.estatus IS NOT NULL THEN asi.estatus
                WHEN aut.estatusIn IN ('Mantenimiento', 'En servicio') THEN aut.estatusIn
                ELSE 'Disponible'
            END AS estatus_final
        FROM automoviles AS aut
        LEFT JOIN asignacions AS asi
            ON aut.id_automovil = asi.id_automovil
            AND asi.id_asignacion = (
                SELECT MAX(sub.id_asignacion)
                FROM asignacions AS sub
                WHERE sub.id_automovil = asi.id_automovil
                AND sub.estatus IS NOT NULL
            )
    ");
    


        

        // dd($disponibilidad);
        return view('modulos.Gestion.index', compact('disponibilidad'));
    }

    public function show(string $id)
    {
        $dispo = asignacion::with('automovil', 'checkIns')
            ->where('id_asignacion', $id)
            ->get();
        return view('modulos.Gestion.show', compact('dispo',));
    }


    public function update($id, Request $request)
    {
        $query = asignacion::find($id);
        $query->estatus = 'Autorizado';
        $query->save();

        // Redirigir a la vista de Gestión después de la actualización
        return redirect()->route('Gestion');
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
