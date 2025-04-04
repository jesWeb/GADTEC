<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use App\Models\Automoviles;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    public function index(Request $request)
    {
        $reservacion = Asignacion::select(
            'asignacions.id_asignacion',
            'asignacions.estatus',
            'asignacions.lugar',
            'asignacions.hora_salida',
            'asignacions.fecha_salida',
            'check_ins.km_llegada',
            DB::raw("CONCAT(usuarios.nombre, ' ', usuarios.app, ' ', usuarios.apm) AS usuario"),
            DB::raw("CONCAT(automoviles.marca, ' ', automoviles.submarca, ' ', automoviles.modelo) AS automovil")
        )
        ->join('usuarios', 'asignacions.id_usuario', '=', 'usuarios.id_usuario')
        ->join('automoviles', 'asignacions.id_automovil', '=', 'automoviles.id_automovil')
        ->leftJoin('check_ins', 'check_ins.id_asignacion', '=', 'asignacions.id_asignacion')
        ->whereNull('asignacions.deleted_at')
        ->orderBy('asignacions.id_asignacion', 'asc');  

    
        // Busqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $reservacion->where(function ($query) use ($search) {
                $query->where('asignacions.estatus', 'LIKE', "%{$search}%")
                      ->orWhere('asignacions.lugar', 'LIKE', "%{$search}%")
                      ->orWhere('asignacions.fecha_salida', 'LIKE', "%{$search}%")
                      ->orWhere('usuarios.nombre', 'LIKE', "%{$search}%")
                      ->orWhere('usuarios.app', 'LIKE', "%{$search}%")
                      ->orWhere('usuarios.apm', 'LIKE', "%{$search}%")
                      ->orWhere('automoviles.marca', 'LIKE', "%{$search}%")
                      ->orWhere('automoviles.submarca', 'LIKE', "%{$search}%")
                      ->orWhere('automoviles.modelo', 'LIKE', "%{$search}%");
            });
        }
    
        $reservacion = $reservacion->orderBy('asignacions.fecha_salida', 'desc')
            ->paginate(10)
            ->appends($request->query());
    
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
            'fecha_salida' => 'required|date|after_or_equal:today',
            'hora_salida' => 'required|date_format:H:i',
            'lugar' => 'required|string',
            'motivo' => 'required|string',
            'no_licencia' => 'required|string',
            'condiciones' => 'nullable|string',
            'requierechofer' => 'nullable|boolean',
            'nombre_chofer' => 'nullable|string',
        ], [
            'fecha_salida.after_or_equal' => 'La fecha de salida no puede ser anterior a hoy.',
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

    public function reservacionesPorAutomovil(Request $request)
{
    $id_automovil = $request->query('id_automovil');

    if (!$id_automovil) {
        return response()->json(['error' => 'ID de automóvil requerido'], 400);
    }

    $reservaciones = Asignacion::where('id_automovil', $id_automovil)
        ->whereIn('estatus', ['Reservado', 'Autorizado', 'Ocupado'])
        ->orderBy('fecha_salida', 'asc')
        ->orderBy('hora_salida', 'asc')
        ->get();

    return response()->json($reservaciones);
}

}