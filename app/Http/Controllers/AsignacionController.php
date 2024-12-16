<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use App\Models\Automoviles;
use App\Models\Usuarios;
use Illuminate\Http\Request;



class AsignacionController extends Controller
{

    public function index()
    {


        $reservacion = \DB::select("SELECT
            asi.id_asignacion,
            asi.estatus,
            asi.lugar,
            asi.hora_salida,
            CONCAT(usu.app, ' ', usu.apm, ', ', usu.nombre) AS usuario,
            asi.fecha_salida,
            che.km_llegada,
            CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil
        FROM
            asignacions AS asi
        JOIN
            usuarios AS usu ON asi.id_usuario = usu.id_usuario
        JOIN
            automoviles AS aut ON asi.id_automovil = aut.id_automovil
        LEFT JOIN
            check_ins AS che ON che.id_asignacion = asi.id_asignacion;
        ");

        return view('catalogos.asignacion.index', compact('reservacion'));
    }

    public function create()
    {

        $auto = \DB::select(
        "SELECT
            aut.id_automovil,
            aut.marca,
            aut.submarca,
            aut.modelo,
            aut.estatusIn,
            asi.estatus
        FROM
            automoviles AS aut
        LEFT JOIN asignacions AS asi
            ON aut.id_automovil = asi.id_automovil
            AND asi.estatus IN ('Reservado', 'Ocupado', 'Autorizado')
        WHERE
            aut.estatusIn = 'Disponible'
            AND asi.id_asignacion IS NULL"
        );

        $reservU = Usuarios::all();
        return view('catalogos.asignacion.create', compact('auto', 'reservU'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'telefono' => 'required|numeric',
            'fecha_salida' => 'required|date',
            'hora_salida' => 'nullable|date_format:H:i',
            'hora_llegada' => 'nullable|date_format:H:i',
            'lugar' => 'required|string',
            'requierechofer' => 'nullable',
            'nombre_chofer' => 'nullable|string',
            'motivo' => 'required|string',
            'no_licencia' => 'required|string',
            'condiciones' => 'nullable|string',
            'autorizante' => 'nullable|string',
        ]);

        //verificar si ya esta apartado

        $newAsig = new asignacion($validated);

        // Si no se requiere chofer, el campo nombre_chofer  debe estar vacío
        // if (!$request->has('requierechofer')) {
        //     $newAsig->nombre_chofer = 'N/A';
        // }
        $newAsig->save();

        return redirect()->route('asignacion.index')->with('success', 'Asignación creada con éxito.');
    }




    public function show($id)
    {
        $asignacionV = asignacion::findOrFail($id);
        return view('catalogos.asignacion.show', compact('asignacionV'));
    }

    public function edit($id)
    {
        $EddtAsig = asignacion::findOrFail($id);
        $usuarios = Usuarios::all();


        return view('catalogos.asignacion.edit', compact('EddtAsig', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $EddtAsig = asignacion::findOrFail($id);
        $input = $request->all();
        $EddtAsig->update($input);

        return redirect()->route('asignacion.index')->with('mensaje', 'Se ha actualizado el registro');
    }


    public function destroy($id)
    {
        $DelAsg = asignacion::findOrFail($id);
        $DelAsg->delete();
        return redirect()->route('asignacion.index')->with('eliminar', 'se ha eliminado el registro');
    }
}
