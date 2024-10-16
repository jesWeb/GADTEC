<?php

namespace App\Http\Controllers;

use App\Models\verificacion;
use Illuminate\Http\Request;

class VerificacionesController extends Controller
{

    public function index()
    {

        $verificacion = verificacion::all();
        return view('catalogos.verificaciones.index', compact('verificacion'));
    }

    public function create()
    {
        $verificar = verificacion::all();
        return view('catalogos.verificaciones.create', compact('verificar'));
    }

    public function store(Request $request)
    {

        // $rules = [
        //     'vehiculo' => 'required|string|max:20',
        //     'holograma' => 'required|string|max:20',
        //     'engomado' => 'required|string|max:4',
        //     'fechaV' => 'required|date',
        //     'fechaP' => 'required|date',
        //     'observaciones' => 'nullable|string|max:255',
        //     'image' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
        // ];


        // $messages = [
        //     'vehiculo.required' => 'El campo vehículo es requerido.',
        //     'vehiculo.string' => 'El campo vehículo debe ser una cadena de texto.',
        //     'vehiculo.max' => 'El campo vehículo no puede exceder los 20 caracteres.',
        //     'holograma.required' => 'El campo holograma es requerido.',
        //     'holograma.string' => 'El campo holograma debe ser una cadena de texto.',
        //     'holograma.max' => 'El campo holograma no puede exceder los 20 caracteres.',
        //     'engomado.required' => 'El campo engomado es requerido.',
        //     'engomado.string' => 'El campo engomado debe ser una cadena de texto.',
        //     'engomado.max' => 'El campo engomado no puede exceder los 4 caracteres.',
        //     'fechaV.required' => 'El campo fecha de vencimiento es requerido.',
        //     'fechaV.date' => 'El campo fecha de vencimiento debe ser una fecha válida.',
        //     'fechaP.required' => 'El campo fecha de pago es requerido.',
        //     'fechaP.date' => 'El campo fecha de pago debe ser una fecha válida.',
        //     'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
        //     'observaciones.max' => 'El campo observaciones no puede exceder los 255 caracteres.',
        //     'image.file' => 'El campo imagen debe ser un archivo.',
        //     'image.mimes' => 'El campo imagen debe ser de tipo: jpeg, png, jpg,pdf',
        //     'image.max' => 'El campo imagen no puede exceder los 2048 kilobytes.',
        // ];

        // $validatedData = $request->validate($rules, $messages);

        // $input = $request->all();

        // //image
        // if ($request->file('image') != '') {

        //     // obtener el campo file definido en el formulario
        //     $file = $request->file('image');
        //     // obtener el nombre dek archivo
        //     $img = $file->getClientOriginalName();
        //     //obtener fecha y hora
        //     $ldate = date('Ymd_His_');
        //     //concatena la fecha y hora con el nombre del Archivo (img)
        //     $img2 = $ldate . $img;
        //     //idicamos el nombre  y la ruta donde se almacena el archivo (img)
        //     $file->move(public_path('img/verificaciones'), $img2);
        //     $input['verificacion'] = $img2;
        //


        // verificacion::create($input);

        // return response()->json(['message' => 'Registro creado exitosamente.'], 201);
        // return to_route('Automovil.index');

        // }

        $validatedData = $request->all();

        //calculo proxima fecha
        $ultimaFecha = \Carbon\Carbon::parse($validatedData['fechaV']);
        $proximaV = $ultimaFecha->addMonths(6);
        $input['fechaP'] = $proximaV->format('Y-m-d');

        $newVer = new verificacion();
        $newVer->vehiculo = $request->input('vehiculo');
        $newVer->holograma = $request->input('holograma');
        $newVer->engomado = $request->input('engomado');
        $newVer->fechaV = $request->input('fechaV');
        $newVer->fechaP = $request->input('fechaP');
        $newVer->observaciones = $request->input('observaciones');

        //guardamos datos en BD
        $newVer->save();

        return to_route('verificaciones.index');
    }

    public function show($id)
    {
        //
        $MostrarVer = verificacion::findOrfail($id);
        return view('catalogos.verificaciones.show', compact('MostrarVer'));
    }

    public function edit($id)
    {
        //
        $EddVer = verificacion::find($id);
        return view('catalogos.verificaciones.edit', compact('EddVer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $ultimaFecha = \Carbon\Carbon::parse($validatedData['fechaV']);
        $proximaV = $ultimaFecha->addMonths(6);
        $input['fechaP'] = $proximaV->format('Y-m-d');

        $EddVer = verificacion::findOrFail($id);
        $input = $request->all();
        $EddVer->update($input);

        return to_route('verificaciones.index');

    }

    public function destroy($id)
    {
        //
        $DelVer = verificacion::findOrFail($id);
        $DelVer->delete();
        return to_route('verificaciones.index');
    }
}
