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
        $reservacion = asignacion::with('automovil')->get();
        return view('catalogos.asignacion.index', compact('reservacion'));

    }

    public function create()
    {
        $reservC = Automoviles::all();
        $reservU = Usuarios::all();
        return view('catalogos.asignacion.create', compact('reservC',' reservU'));
    }

    public function store(Request $request)
    {

        $newAsig = new asignacion();
        $newAsig->id_ususario = $request->input('id_ususario');
        $newAsig->telefono = $request->input('telefono');
        $newAsig->requierechofer = $request->input('requierechofer');
        $newAsig->nombre_chofer = $request->input('nombre_chofer');
        $newAsig->vehiculo = $request->input('vehiculo');
        $newAsig->lugar = $request->input('lugar');
        $newAsig->hora_salida = $request->input('hora_salida');
        $newAsig->dia_salida = $request->input('fecha_salida');
        $newAsig->no_licencia = $request->input('no_licencia');
        $newAsig->condiciones = $request->input('condiciones');
        $newAsig->observaciones = $request->input('observaciones');
        $newAsig->autorizante = $request->input('autorizante');
         //guardamos datos en BD
         $newAsig ->save();

        return to_route('asignacion.index');
    }

    public function show($id)
    {
        $reseSh = asignacion::findOrFail($id);
        return view('catalogos.asignacion.show', compact('reseSh'));
    }

    public function edit($id)
    {

        $EddtAsig = asignacion::find($id);
        return view('catalogos.asignacion.edit', compact('EddtAsig'));
    }

    public function update(Request $request, $id) {

        $EddtAsig = asignacion::findOrFail($id);
        $input=$request->all();
        $EddtAsig->update($input);

        return to_route('asignacion.index');
    }

    public function destroy($id) {
        $DelAsg = asignacion::findOrFail($id);
        $DelAsg ->delete();
        return to_route('asignacion.index');
    }
}
