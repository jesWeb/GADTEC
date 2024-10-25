<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\seguros;
use Illuminate\Http\Request;

class SegurosController extends Controller
{

    public function index()
    {
        //
        $seguro = seguros::with('automovil')->get();
        return view('catalogos.seguros.index', compact('seguro'));
    }


    public function create()
    {
        //
        $automoviles = Automoviles::all();
        return view('catalogos.seguros.create', compact('automoviles'));
    }


    public function store(Request $request)
    {

         $newSeg = new seguros();
         $newSeg->id_automovil = $request->input('id_automovil');
         $newSeg->aseguradora = $request->input('aseguradora');
         $newSeg->cobertura = $request->input('cobertura');
         $newSeg->fecha_vigencia = $request->input('fecha_vigencia');
         $newSeg->estatus = $request->input('estatus');
         $newSeg->monto = $request->input('monto');

        //guardamos datos en BD
         $newSeg->save();

        return to_route('seguros.index');
    }

    public function show($id)
    {
        $seguroS = seguros::findOrfail($id);

        return view('catalogos.seguros.show', compact('seguroS'));
    }

    public function edit($id)
    {
        $EddSeg = seguros::findOrFail($id);
        $automoviles = Automoviles::all();
        return view('catalogos.seguros.edit', compact('EddSeg','automoviles'));
    }

    public function update(Request $request,  $id)
    {
        $EddSeg = seguros::findOrFail($id);
        $input = $request->all();
        $EddSeg->update($input);
        return to_route('seguros.index');
    }

    public function destroy($id)
    {
        $DelSeg = seguros::findOrFail($id);
        $DelSeg->delete();
        return to_route('seguros.index');
    }
}
