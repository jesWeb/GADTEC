<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Automoviles;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $servicios = Servicios::with('automovil')->get();
        return view('modulos.servicios.index', compact('servicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        //
        $automoviles = Automoviles::all();
        return view('modulos.servicios.add', compact('automoviles'));
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request){
        $rules = [
            'tipo_servicio' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'fecha_servicio' =>'nullable|date',
            'prox_servicio' =>'nullable|date',
            'costo' => 'required|numeric',
            'lugar_servicio' => 'nullable|string|max:255',
            'id_automovil' => 'nullable|exists:automoviles,id_automovil'
        ];

        $messages = [
            'tipo_servicio.required' => 'El campo tipo de servicio es requerido',
            'descripcion.nullable' => 'El campo descripción es opcional',
            'fecha_servicio.nullable' => 'El campo fecha de servicio es opcional',
            'prox_servicio.nullable' => 'El campo próximo servicio es opcional',
            'costo.required' => 'El campo costo es requerido',
            'lugar_servicio.nullable' => 'El campo lugar de servicio es opcional',
            'id_automovil.exists' => 'El campo automóvil no existe'
        ];

        $request->validate($rules, $messages);
        $input = $request->all();
        Servicios::create($input);
        return redirect('servicios')->with('message', 'Se ha creado correctamente el registro');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $servicio = Servicios::findOrFail($id);
        return view('modulos.servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
        $servicio = Servicios::findOrFail($id);
        $automoviles = Automoviles::all();
        return view('modulos.servicios.edit', compact('servicio', 'automoviles'));
    }

    /**
     * Update the specified resource in storage.
     */
   
    public function update(Request $request, string $id)
    {
        //
        $rules = [
            'tipo_servicio' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'fecha_servicio' =>'nullable|date',
            'prox_servicio' =>'nullable|date',
            'costo' => 'required|numeric',
            'lugar_servicio' => 'nullable|string|max:255',
            'id_automovil' => 'nullable|exists:automoviles,id_automovil'
        ];

        $messages = [
            'tipo_servicio.required' => 'El campo tipo de servicio es requerido',
            'descripcion.nullable' => 'El campo descripción es opcional',
            'fecha_servicio.nullable' => 'El campo fecha de servicio es opcional',
            'prox_servicio.nullable' => 'El campo próximo servicio es opcional',
            'costo.required' => 'El campo costo es requerido',
            'lugar_servicio.nullable' => 'El campo lugar de servicio es opcional',
            'id_automovil.exists' => 'El campo automóvil no existe'
        ];

        $request->validate($rules, $messages);
        $input = $request->all();
        $servicio = Servicios::findOrFail($id);

        $servicio->update($input);
        return redirect('servicios')->with('message', 'Se ha actualizado correctamente el registro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $servicio = Servicios::findOrFail($id);
        $servicio->delete();
        return back()->with('message', 'Se ha eliminado correctamente el registro');
    }
}