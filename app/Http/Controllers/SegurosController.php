<?php

namespace App\Http\Controllers;

use App\Models\seguros;
use Illuminate\Http\Request;

class SegurosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $seguro = seguros::all();
        return view('catalogos.seguros.index', compact('seguro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $seguros = new seguros();
        return view('catalogos.seguros.create', compact('seguros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'cobertura' => 'required|string|max:255',
        //     'fecha_vigencia' => 'required|date',
        //     'monto' => 'required|string|max:255',
        //     'poliza' => 'nullable|image',
        //     'estatus' => 'required',
        // ]);



        // seguros::create($validated);

         $newSeg = new seguros();
         $newSeg->vehiculo = $request->input('vehiculo');
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
        $seguroS = seguros::find($id);

        return view('catalogos.seguros.show', compact('seguroS'));
    }

    public function edit($id)
    {
        //
        $EddSeg = seguros::find($id);
        return view('catalogos.seguros.edit', compact('EddSeg'));
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
