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
    }

    public function create()
    {
        $reservC = asignacion::all();

        // dd($auto);
        return view('catalogos.asignacion.create', compact('reservC',));
    }

    public function store(Request $request)
    {
        // dd($request);

        // $rules = [
        //     'solicitante' => 'required|string',
        //     'telefono' => 'required',
        //     'requierechofer' => 'required|boolean',
        //     'nombre_chofer' => 'nullable|string',
        //     'vehiculo' => 'required',
        //     'lugar' => 'required',
        //     'hora_salida' => 'required ',
        //     'no_licencia' => 'required',
        //     'condiciones' => 'nullable',
        //     'observaciones' => 'nullable',
        //     'autorizante' => 'required',
        // ];
        // $messages = [
        //     'solicitante.required' => 'El campo tipo de multa es requerido',
        //     'telefono.required' => 'El campo monto es requerido',
        //     'requierechofer.required' => 'La fecha de multa es requerida',
        //     'nombre_chofer.required' => 'El campo lugar es requerido',
        //     'vehiculo' => 'El campo estatus es requerido',
        //     'hora_salida' => 'El campo comprobante es opcional',
        //     'no_licencia' => 'El campo observaciones es opcional',
        //     'condiciones' => 'El campo automóvil no existe',
        //     'observaciones' => 'El campo automóvil no existe',
        //     'autorizante' => 'El campo automóvil no existe'
        // ];

        // $input = $request->validate($rules,$messages);

        // $input = $request->all();

        // $input = new asignacion();


        // asignacion::create($input);

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
        $MostrarAsig = asignacion::find($id);
        return view('catalogos.asignacion.show', compact('MostrarAsig'));
    }


    public function edit($id)
    {
        $EddtAsig = asignacion::findOrFail($id);
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
