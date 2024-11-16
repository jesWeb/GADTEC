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
        $reservacion = asignacion::with('automovil', 'usuarios')->get();
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
            'fecha_estimada_dev' => 'required|date',
            'hora_salida' => 'required|date_format:H:i',
            'hora_llegada' => 'required|date_format:H:i',
            'lugar' => 'required|string',
            'motivo' => 'required|string',
            'no_licencia' => 'required|string',
            'condiciones' => 'nullable|string',
            'autorizante' => 'required|string',
        ]);
        //fecha y hora a objetos
        $fecha_reservada = Carbon::parse($request->fecha_salida . '' . $request->hora_salida);

        //validar si el carro esta dispo en la hora y fecha
        $AsigExistente = asignacion::where('id_automovil', $request->id_automovil)
            //verificar misma fecha
            ->where('fecha_salida', $request->fecha_salida)
            ->where(function ($query) use ($fecha_reservada) {
                // ajuste de la duración de la asignación
                $query->whereBetween('hora_salida', [$fecha_reservada->format('H:i'), $fecha_reservada->addMinutes(15)->format('H:i')]);
            })->exists();

        if ($AsigExistente) {
            return back()->withErrors(['error' => 'Ya existe una asignación para este auto en este horario .']);
        }

        $newAsig = new asignacion($validated);

        // Asignar datos automáticamente
        // $newAsig->fecha_asignacion = Carbon::now();


        // Si no se requiere chofer, el campo nombre_chofer  debe estar vacío
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
        // dd(asignacion::findOrFail($id)->toSql());

        return view('catalogos.asignacion.edit', compact('EddtAsig'));
    }

    public function update(Request $request, $id)
    {

        $EddtAsig = asignacion::findOrFail($id);
        $input = $request->all();
        $EddtAsig->update($input);

        return redirect()->route('asignacion.index')->with('message', 'Se ha actualizado el registro');
    }

    public function destroy($id)
    {
        $DelAsg = asignacion::findOrFail($id);
        $DelAsg->delete();
        return redirect()->route('asignacion.index')->with('eliminar', 'se ha eliminado el registro');
    }
}
