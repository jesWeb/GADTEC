<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use App\Models\Automoviles;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsignacionController extends Controller
{

    public function index()
    {
        // $reservacion = asignacion::paginate(10);
        $reservacion = asignacion::with('automovil','usuarios')->get();
        return view('catalogos.asignacion.index', compact('reservacion'));
    }

    public function create()
    {
        $auto = Automoviles::all();
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
            'hora_salida' => 'required',
            'lugar' => 'required|string',
            'motivo' => 'required|string',
            'estatus' => 'required|string',
            'no_licencia' => 'required|string',
            'condiciones' => 'nullable|string',
            'autorizante' => 'required|string',
        ]);
    
        // Validación de existencia
        $asigExt = asignacion::where('id_automovil', $request->id_automovil)
            ->where('fecha_salida', $request->fecha_salida)
            ->where('hora_salida', $request->hora_salida)
            ->exists();
    
        if ($asigExt) {
            return back()->withErrors(['error' => 'Ya existe una asignación para este auto en este horario.']);
        }
    
        $newAsig = new asignacion($validated);
        
        // Asignar datos automáticamente
        $newAsig->fecha_asignacion = Carbon::now();
        $newAsig->fecha_estimada_dev = Carbon::now()->addDays(7);
        
    
        // Si no se requiere chofer, asegurarse de que el campo `nombre_chofer` esté vacío
        if (!$request->has('requierechofer')) {
            $newAsig->nombre_chofer = null;
        }
    
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
        return view('catalogos.asignacion.edit', compact('EddtAsig'));
    }

    public function update(Request $request, $id)
    {

        $EddtAsig = asignacion::findOrFail($id);
        $input = $request->all();
        $EddtAsig->update($input);

        return to_route('asignacion.index');
    }

    public function destroy($id)
    {
        $DelAsg = asignacion::findOrFail($id);
        $DelAsg->delete();
        return to_route('asignacion.index');
    }
}
