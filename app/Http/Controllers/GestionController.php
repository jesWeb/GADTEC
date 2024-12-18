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

    public function __construct()
    {
        $this->middleware('auth:usuarios');
    }


    public function index()
    {

        $disponibilidad = DB::select("SELECT aut.*, asi.id_asignacion, asi.estatus
            FROM automoviles AS aut
            LEFT JOIN (
                SELECT id_automovil, id_asignacion, estatus
                FROM asignacions
                WHERE (id_automovil, id_asignacion) IN (
                    SELECT id_automovil, MAX(id_asignacion)
                    FROM asignacions
                    GROUP BY id_automovil
                )
            ) AS asi
            ON aut.id_automovil = asi.id_automovil
            WHERE aut.deleted_at IS NULL
            ORDER BY aut.marca
            ");
        // dd($disponibilidad);
        return view('modulos.Gestion.index', compact('disponibilidad'));
    }

    public function show(string $id)
    {
        $dispo = DB::select("SELECT
            aut.marca,
            aut.submarca,
            aut.modelo,
            asi.id_asignacion,
            asi.fecha_salida AS fecha,
            CONCAT(usu.nombre, ' ', usu.app, ' ', usu.apm) AS solicitante,
            asi.nombre_chofer AS chofer,
            che.hora_salida,
            che.hora_llegada,
            che.km_llegada AS kilometraje,
            che.combustible_llegada AS combustible,
            asi.estatus
        FROM automoviles AS aut
        INNER JOIN asignacions AS asi ON aut.id_automovil = asi.id_automovil
        INNER JOIN check_ins AS che ON asi.id_asignacion = che.id_asignacion
        INNER JOIN usuarios AS usu ON asi.id_usuario = usu.id_usuario
        WHERE aut.id_automovil = $id");

        $auto = \DB::select("SELECT CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo)
        AS automovil
        FROM automoviles AS aut
        WHERE aut.id_automovil=$id");

        return view('modulos.Gestion.show', compact('dispo', 'auto'));
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
