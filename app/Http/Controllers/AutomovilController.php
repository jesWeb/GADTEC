<?php

namespace App\Http\Controllers;

use App\Models\Automovil;
use Illuminate\Http\Request;

class AutomovilController extends Controller
{
    public function index()
    {
        //
        $cars = Automovil::paginate(10);
        // $cars = Automovil::all();

        return view('catalogos.Automovil.index', compact('cars'));
    }
    public function create()
    {
        $AutoC = Automovil::all();
        // dd($auto);
        return view('catalogos.Automovil.create', compact('AutoC'));
    }
    public function store(Request $request)
    {
        // dd($request);

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

        if ($request->file('image') != '') {

            // obtener el campo file definido en el formulario
            $file = $request->file('image');
            // obtener el nombre dek archivo
            $img = $file->getClientOriginalName();
            //obtener fecha y hora
            $ldate = date('Ymd_His_');
            //concatena la fecha y hora con el nombre del Archivo (img)
            $img2 = $ldate . $img;
            //idicamos el nombre  y la ruta donde se almacena el archivo (img)
            $file->move(public_path('img/carros'), $img2);
            $input['carros'] = $img2;
        } else {
            $img2 = "CarroNull.jpg";
        }

        Automovil::create($input);

        // dd($Newauto);

        // return redirect('Automovil.index')->with('message', 'Se ha creado correctamente el registro');
        return to_route('Automovil.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $automovil = Automovil::find($id);
        return view('catalogos.Automovil.show', compact('automovil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $EddCar=Automovil::findOrFail($id);
        return view('catalogos.Automovil.edit', compact('EddCar'));
    }




    public function update(Request $request, $id)
    {
        //

        $EddCar = Automovil::findOrFail($id);

        $input = $request->all();


        // dd($post);
        $EddCar->update($input);
        return redirect('Automovil')->with('message', 'Se ha modificado correctamente el registro');
    }

    public function destroy($id)
    {   $cars = Automovil::findOrFail($id);
        $cars ->delete();
        return to_route('Automovil.index');
    }
}
