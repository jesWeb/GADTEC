<?php

namespace App\Http\Controllers;

use App\Models\asignacion;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{

    public function index()
    {
        //
         $reservacion = asignacion::all();
        // $cars = Automovil::all();

        return view('catalogos.reservaciones.index', compact('reservacion'));
    }

    public function create()
    {
         $reservC = asignacion::all() ;
        // dd($auto);
        return view('catalogos.reservaciones.create', compact('reservC'));
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
            'modelo' => 'required|string|max:4',
            'motor' => 'required|string|max:50',
            'kilometraje' => 'required|integer',
            'placas' => 'nullable|string|max:255',
            'NSI' => 'nullable|string|max:20',
            'observaciones' => 'nullable|string|max:255',
            'uso' => 'nullable|string',
            'responsable' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg',
        ];

        $messages = [
            'marca.required' => 'El campo marca es requerido.',
            'submarca.required' => 'El campo submarca es requerido.',
            'modelo.required' => 'El campo modelo es requerido.',
            'modelo.integer' => 'El campo modelo debe ser un número entero.',
            'modelo.min' => 'El campo modelo debe ser al menos 1.',
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
            'uso.exists' => 'El campo uso debe ser un valor válido.',
            'responsable.required' => 'El campo responsable es requerido.',
            'responsable.string' => 'El campo responsable debe ser una cadena de texto.',
            'responsable.max' => 'El campo responsable no puede exceder los 100 caracteres.',
            'image.file' => 'El campo imagen debe ser un archivo.',
            'image.mimes' => 'El campo imagen debe ser de tipo: jpeg, png, jpg.',
            'image.max' => 'El campo imagen no puede exceder los 2048 kilobytes.',

        ];

        $request->validate($rules, $messages);
        $input = $request->all();



        asignacion::create($input);

        // dd($Newauto);

        // return redirect('Automovil.index')->with('message', 'Se ha creado correctamente el registro');
        return to_route('Automovil.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(asignacion $id)
    {
        //

        $automovil = asignacion::findOrFail($id);

        return view('catalogos.reservaciones.show', compact('automovil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asignacion $id)
    {
        //
        $reservEdit = asignacion::find($id);
        return view('catalogos.reservaciones.edit', compact('reservEdit'));
    }



    public function update(Request $request, asignacion $id)
    {
        //
}

    public function destroy(asignacion $id)
    {
        //


    }
}

