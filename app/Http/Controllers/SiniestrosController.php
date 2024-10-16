<?php

namespace App\Http\Controllers;

use App\Models\siniestros;
use App\Models\verificacion;
use Illuminate\Http\Request;

class SiniestrosController extends Controller
{

    public function index()
    {
        //
        $siniestros = siniestros::all();
        return view('catalogos.siniestros.index',compact('siniestros'));
    }


    public function create()
    {
        //
        $siniestroC = siniestros::all();
        return view('catalogos.siniestros.create',compact('siniestroC'));
    }


    public function store(Request $request)
    {


        $newVer = new verificacion();
        $newVer->fecha_siniestro = $request->input('fecha_siniestro');
        $newVer->telefono = $request->input('telefono');
        $newVer->requierechofer = $request->input('requierechofer');
        $newVer->nombre_chofer = $request->input('nombre_chofer');
        $newVer->vehiculo = $request->input('vehiculo');
        $newVer->lugar = $request->input('lugar');
        $newVer->hora_salida = $request->input('hora_salida');
        $newVer->no_licencia = $request->input('no_licencia');
        $newVer->condiciones = $request->input('condiciones');
        $newVer->observaciones = $request->input('observaciones');
        $newVer->autorizante = $request->input('autorizante');

         //guardamos datos en BD
         $newVer ->save();

        return to_route('siniestro.index');
    }


    public function show($id)
    {
        //
        $ViewSini = siniestros::findOrfail($id);
        return view('catalogos.siniestro.show', compact('ViewSini'));

    }

    public function edit($id)
    {
        //
        $SinEdit = siniestros::find($id);
        return view('catalogos.siniestro.edit', compact('SinEdit'));
    }


    public function update(Request $request,  $id)
    {
        //
    }


    public function destroy( $id)
    {
        //
    }
}
