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
        //
        $rules = [
            'marca' => 'required|string|max:20',
            'submarca' => 'required|string|max:20',
            'modelo' => 'required|integer|min:1|max:9999', // Asegurando que sea un número entero válido
            'motor' => 'required|string|max:50',
            'kilometraje' => 'required|integer|min:0', // Evitando kilometraje negativo
            'placas' => 'nullable|string|max:255',
            'NSI' => 'nullable|string|max:20',
            'observaciones' => 'nullable|string|max:255',
            'uso' => 'nullable|string',
            'responsable' => 'required|string|max:100', // Limitando el tamaño
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048', // Limitando el tamaño del archivo
        ];

        $messages = [
            'marca.required' => 'El campo marca es requerido.',
            'submarca.required' => 'El campo submarca es requerido.',
            'modelo.required' => 'El campo modelo es requerido.',
            'modelo.integer' => 'El campo modelo debe ser un número entero.',
            'modelo.min' => 'El campo modelo debe ser al menos 1.',
            'modelo.max' => 'El campo modelo no puede exceder 9999.',
            'motor.required' => 'El campo motor es requerido.',
            'motor.string' => 'El campo motor debe ser una cadena de texto.',
            'motor.max' => 'El campo motor no puede exceder los 50 caracteres.',
            'kilometraje.required' => 'El campo kilometraje es requerido.',
            'kilometraje.integer' => 'El campo kilometraje debe ser un número entero.',
            'kilometraje.min' => 'El campo kilometraje no puede ser negativo.',
            'placas.string' => 'El campo placas debe ser una cadena de texto.',
            'placas.max' => 'El campo placas no puede exceder los 255 caracteres.',
            'NSI.string' => 'El campo NSI debe ser una cadena de texto.',
            'NSI.max' => 'El campo NSI no puede exceder los 20 caracteres.',
            'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
            'observaciones.max' => 'El campo observaciones no puede exceder los 255 caracteres.',
            'uso.string' => 'El campo uso debe ser una cadena de texto.',
            'responsable.required' => 'El campo responsable es requerido.',
            'responsable.string' => 'El campo responsable debe ser una cadena de texto.',
            'responsable.max' => 'El campo responsable no puede exceder los 100 caracteres.',
            'image.file' => 'El campo imagen debe ser un archivo.',
            'image.mimes' => 'El campo imagen debe ser de tipo: jpeg, png, jpg.',
            'image.max' => 'El campo imagen no puede exceder los 2048 kilobytes.',
        ];


        $request->validate($rules, $messages);
        $input = $request->all();


        seguros::create($input);

        return to_route('seguros.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(seguros $id)
    {
        //
        $seguroS = seguros::find($id);

        return view('catalogos.seguros.show', compact('seguroS'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(seguros $id)
    {
        //
        $SeguroEdit = seguros::find($id);
        return view('catalogos.seguros.edit', compact('SeguroEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, seguros $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(seguros $id)
    {
        //
    }
}
