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


        //validacion de hora y dia existente
        $asigExt = asignacion::where('id_automovil', $request->id_automovil)
            ->where('fecha_salida', $request->fecha_salida)
            ->where('hora_salida', $request->hora_salida)
            ->exists();

        if ($asigExt) {
            return back()->withErrors(['error' => 'Ya esxite una asignacion para este auto en este horario ']);

        } else {
            $newAsig = new asignacion();
            $newAsig->id_usuario = $request->input('id_usuario');
            $newAsig->id_automovil = $request->input('id_automovil');
            $newAsig->telefono = $request->input('telefono');
            $newAsig->requierechofer = $request->input('requierechofer');
            $newAsig->nombre_chofer = $request->input('nombre_chofer');
            $newAsig->lugar = $request->input('lugar');
            $newAsig->hora_salida = $request->input('hora_salida');
            $newAsig->fecha_salida = $request->input('fecha_salida');
            $newAsig->no_licencia = $request->input('no_licencia');
            $newAsig->estatus = $request->input('estatus');
            $newAsig->condiciones = $request->input('condiciones');
            $newAsig->observaciones = $request->input('observaciones');
            $newAsig->autorizante = $request->input('autorizante');
            //guardamos datos en BD
            $newAsig->save();
        }


        return to_route('asignacion.index')->with('success', 'Asignación creada con éxito.');
    }

    public function show($id)
    {
        $asignacionV = asignacion::findOrFail($id);
        return view('catalogos.asignacion.show', compact('asignacionV'));
    }

    public function edit($id)
    {
        // $EddtAsig = asignacion::findOrFail($id);
        dd(asignacion::findOrFail($id)->toSql());

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
