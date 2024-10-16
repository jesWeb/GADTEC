<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{

    public function index()
    {
        //
        // $reservacion = asignacion::paginate(10);
        $reservacion = asignacion::all();
        return view('catalogos.asignacion.index', compact('reservacion'));
         $reservacion = asignacion::all();
        // $cars = Automovil::all();

        return view('catalogos.asignacion.index', compact('reservacion'));
    }

    public function create()
    {
        $reservC = asignacion::all();

        // dd($auto);
        return view('catalogos.asignacion.create', compact('reservC',));
    }

    public function store(Request $request)
    {

        $newAsig = new asignacion();
        $newAsig->solicitante = $request->input('solicitante');
        $newAsig->telefono = $request->input('telefono');
        $newAsig->requierechofer = $request->input('requierechofer');
        $newAsig->nombre_chofer = $request->input('nombre_chofer');
        $newAsig->vehiculo = $request->input('vehiculo');
        $newAsig->lugar = $request->input('lugar');
        $newAsig->hora_salida = $request->input('hora_salida');
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
        //

        $automovil = asignacion::findOrFail($id);

        return view('catalogos.reservaciones.show', compact('automovil'));
    }


    public function edit($id)
    {
        //
        $reservEdit = asignacion::find($id);
        return view('catalogos.reservaciones.edit', compact('reservEdit'));
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
