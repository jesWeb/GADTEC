<?php

namespace App\Http\Controllers;

use App\Models\siniestros;
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
        //
        $rules = [
            'fecha_siniestro' => 'required|date', // Campo obligatorio y debe ser una fecha
            'descripcion' => 'required|string|max:255', // Descripción requerida y máxima de 255 caracteres
            'estatus' => 'required|in:activo,vencido', // Debe ser 'activo' o 'vencido'
            'costo_danos_estimados' => 'required|numeric|min:0', // Costo de daños estimados debe ser numérico y no negativo
            'costo_real_danos' => 'required|numeric|min:0', // Costo real de daños debe ser numérico y no negativo
            'responsable' => 'required|string|max:100', // Responsable requerido y máximo de 100 caracteres
            'observaciones' => 'nullable|string|max:255', // Observaciones opcionales y máxima de 255 caracteres
        ];

        $messages = [
            'fecha_siniestro.required' => 'El campo fecha del siniestro es requerido.',
            'fecha_siniestro.date' => 'El campo fecha del siniestro debe ser una fecha válida.',
            'descripcion.required' => 'El campo descripción es requerido.',
            'descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            'descripcion.max' => 'El campo descripción no puede exceder los 255 caracteres.',
            'estatus.required' => 'El campo estatus es requerido.',
            'estatus.in' => 'El campo estatus debe ser uno de los siguientes: activo, vencido.',
            'costo_danos_estimados.required' => 'El campo costo de daños estimados es requerido.',
            'costo_danos_estimados.numeric' => 'El campo costo de daños estimados debe ser numérico.',
            'costo_danos_estimados.min' => 'El campo costo de daños estimados no puede ser negativo.',
            'costo_real_danos.required' => 'El campo costo real de daños es requerido.',
            'costo_real_danos.numeric' => 'El campo costo real de daños debe ser numérico.',
            'costo_real_danos.min' => 'El campo costo real de daños no puede ser negativo.',
            'responsable.required' => 'El campo responsable es requerido.',
            'responsable.string' => 'El campo responsable debe ser una cadena de texto.',
            'responsable.max' => 'El campo responsable no puede exceder los 100 caracteres.',
            'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
            'observaciones.max' => 'El campo observaciones no puede exceder los 255 caracteres.',
        ];
        $request->validate($rules, $messages);
        $input = $request->all();

        siniestros::create($input);
        return to_route('siniestro.index');
    }


    public function show(siniestros $id)
    {
        //
        $ViewSini = siniestros::findOrfail($id);
        return view('catalogos.siniestro.show', compact('ViewSini'));

    }

    public function edit(siniestros $id)
    {
        //
        $SinEdit = siniestros::find($id);
        return view('catalogos.siniestro.edit', compact('SinEdit'));
    }


    public function update(Request $request, siniestros $id)
    {
        //
    }


    public function destroy(siniestros $id)
    {
        //
    }
}
