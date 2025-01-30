<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use App\Models\Automoviles;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    public function index()
    {
        $reservacion = DB::select("SELECT
            asi.id_asignacion,
            asi.estatus,
            asi.lugar,
            asi.hora_salida,
            CONCAT(usu.nombre, ' ', usu.app, ' ', usu.apm) AS usuario,
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
            check_ins AS che ON che.id_asignacion = asi.id_asignacion
        WHERE
            asi.deleted_at IS NULL 
        ");

        return view('catalogos.asignacion.index', compact('reservacion'));
    }

    public function create()
    {
        // Permitir crear solicitudes con diferente fecha y hora
        $auto = DB::select(
        "SELECT
            aut.id_automovil,
            aut.marca,
            aut.submarca,
            aut.modelo,
            aut.estatusIn
        FROM
            automoviles AS aut
        WHERE
            aut.estatusIn = 'Disponible'
            AND NOT EXISTS (
                SELECT 1 FROM asignacions AS asi
                WHERE asi.id_automovil = aut.id_automovil
                AND asi.estatus IN ('Reservado', 'Ocupado', 'Autorizado')
                AND asi.fecha_salida = :fecha_salida
                AND asi.hora_salida = :hora_salida
            )
            AND aut.deleted_at IS NULL",
            ['fecha_salida' => now()->toDateString(), 'hora_salida' => now()->toTimeString()]
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
            'hora_salida' => 'required|date_format:H:i',
            'lugar' => 'required|string',
            'motivo' => 'required|string',
            'no_licencia' => 'required|string',
            'condiciones' => 'nullable|string',
            'requierechofer' => 'nullable|boolean',
            'nombre_chofer' => 'nullable|string',
        ]);
    
        // Ver si el automovil no esta apartado
        $conflicto = DB::table('asignacions')
            ->where('id_automovil', $request->id_automovil)
            ->where('fecha_salida', $request->fecha_salida)
            ->where('hora_salida', $request->hora_salida)
            ->whereIn('estatus', ['Reservado', 'Ocupado', 'Autorizado'])
            ->exists();
    
        if ($conflicto) {
            return redirect()->back()->withErrors(['El vehículo ya está reservado en ese horario.'])->withInput();;
        }
    
        // Guardar la nueva asignación
        $newAsig = new asignacion($validated);
        $newAsig->save();
    
        return redirect()->route('asignacion.index')->with('success', 'La solicitud de automóvil se ha registrado correctamente.');
    }
    public function show($id)
    {
        $asignacionV = asignacion::with('automovil', 'usuarios')->findOrFail($id);

        if (!$asignacionV->automovil || !$asignacionV->usuarios) {
            return view('catalogos.asignacion.show', [
                'asignacionV' => $asignacionV,
                'mensaje' => 'El automóvil o usuario relacionado ha sido eliminado.',
            ]);
        }

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
        return redirect()->route('asignacion.index')->with('eliminar', 'Se ha eliminado el registro');
    }
}