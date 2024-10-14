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

        return view('catalogos.asignacion.index', compact('reservacion'));
    }

    public function create()
    {
         $reservC = asignacion::all() ;
        // dd($auto);
        return view('catalogos.asignacion.create', compact('reservC'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $rules = [
            'vehiculo' => 'required|string|max:50',
            'holograma' => 'required|string|max:20',
            'engomado' => 'required|string|max:20',
            'fechaV' => 'required|date',
            'fechaP' => 'required|date|after_or_equal:fechaV',
            'observaciones' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ];

        $messages = [
            'vehiculo.required' => 'El campo vehículo es requerido.',
            'vehiculo.string' => 'El campo vehículo debe ser una cadena de texto.',
            'vehiculo.max' => 'El campo vehículo no puede exceder los 50 caracteres.',
            'holograma.required' => 'El campo holograma es requerido.',
            'holograma.string' => 'El campo holograma debe ser una cadena de texto.',
            'holograma.max' => 'El campo holograma no puede exceder los 20 caracteres.',
            'engomado.required' => 'El campo engomado es requerido.',
            'engomado.string' => 'El campo engomado debe ser una cadena de texto.',
            'engomado.max' => 'El campo engomado no puede exceder los 20 caracteres.',
            'fechaV.required' => 'El campo fecha de vigencia es requerido.',
            'fechaV.date' => 'El campo fecha de vigencia debe ser una fecha válida.',
            'fechaP.required' => 'El campo fecha de pago es requerido.',
            'fechaP.date' => 'El campo fecha de pago debe ser una fecha válida.',
            'fechaP.after_or_equal' => 'La fecha de pago debe ser igual o posterior a la fecha de vigencia.',
            'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
            'observaciones.max' => 'El campo observaciones no puede exceder los 255 caracteres.',
            'image.file' => 'El campo imagen debe ser un archivo.',
            'image.mimes' => 'El campo imagen debe ser de tipo: jpeg, png, jpg.',
            'image.max' => 'El campo imagen no puede exceder los 2048 kilobytes.',
        ];

        $request->validate($rules, $messages);
        $input = $request->all();



        asignacion::create($input);

        // dd($Newauto);

        // return redirect('Automovil.index')->with('message', 'Se ha creado correctamente el registro');
        return to_route('asignacion.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(asignacion $id)
    {
        //

        $automovil = asignacion::findOrFail($id);

        return view('catalogos.asignacion.show', compact('automovil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asignacion $id)
    {
        //
        $reservEdit = asignacion::find($id);
        return view('catalogos.asignacion.edit', compact('reservEdit'));
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

