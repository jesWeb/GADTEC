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

        $newSin = new siniestros();
        $newSin->fecha_siniestro = $request->input('fecha_siniestro');
        $newSin->descripcion = $request->input('descripcion');
        $newSin->estatus = $request->input('estatus');
        $newSin->costo_danos_estimados = $request->input('costo_danos_estimados');
        $newSin->costo_real_danos = $request->input('costo_real_danos');
        $newSin->responsable = $request->input('responsable');
        $newSin->observaciones = $request->input('observaciones');

         //guardamos datos en BD
         $newSin ->save();

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

        $EddSin = siniestros::find($id);
        return view('catalogos.siniestro.edit', compact('EddSin'));
    }


    public function update(Request $request,  $id)
    {

    }


    public function destroy( $id)
    {

    }
}
