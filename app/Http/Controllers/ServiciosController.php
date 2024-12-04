<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Automoviles;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Servicios::with('automovil');

        // Verificar si hay una búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('tipo_servicio', 'LIKE', "%{$search}%")
                ->orWhere('descripcion', 'LIKE', "%{$search}%")
                ->orWhere('costo', 'LIKE', "%{$search}%")
                ->orWhere('lugar_servicio', 'LIKE', "%{$search}%")
                ->orWhereHas('automovil', function ($q) use ($search) {
                    $q->where('marca', 'LIKE', "%{$search}%")
                        ->orWhere('submarca', 'LIKE', "%{$search}%")
                        ->orWhere('modelo', 'LIKE', "%{$search}%");
                });
            });
        }

        $servicios = $query->get();
        return view('modulos.servicios.index', compact('servicios'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $automoviles = Automoviles::all();
        return view('modulos.servicios.add', compact('automoviles'));
    }
    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $rules = [
             'tipo_servicio' => 'required|string|max:100',
             'descripcion' => 'nullable|string|max:255',
             'fecha_servicio' => 'nullable|date',
             'prox_servicio' => 'nullable|date',
             'costo' => 'nullable|numeric',
             'lugar_servicio' => 'required|string|max:255',
             'comprobante' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
             'id_automovil' => 'nullable|exists:automoviles,id_automovil'
         ];
     
         $messages = [
             'tipo_servicio.required' => 'El campo tipo de servicio es requerido',
             'descripcion.required' => 'El campo descripción es requerido',
             'fecha_servicio.required' => 'El campo fecha de servicio es requerida',
             'prox_servicio.nullable' => 'El campo próximo servicio es opcional',
             'costo.nullable' => 'El campo costo es requerido',
             'lugar_servicio.required' => 'El campo lugar de servicio es requerido',
             'comprobante.nullable' => 'El campo comprobante es opcional',
             'id_automovil.exists' => 'El campo automóvil no existe'
         ];
     
         $request->validate($rules, $messages);
         $input = $request->all();
     
         // Guardar comprobante
         if ($request->hasFile('comprobante')) {
             $file = $request->file('comprobante');
             $comprobante =  $file->getClientOriginalName();
             $ldate = date('Ymd_His_');
             $comprobante = $ldate . $comprobante;
     
             $file->move(public_path('img'), $comprobante);
             $input['comprobante'] = $comprobante;
         }
     
     // Obtener el automóvil relacionado
     $automovil = Automoviles::find($request->id_automovil);
     if (!$automovil) {
         return redirect()->back()->withErrors(['id_automovil' => 'Automóvil no encontrado.']);
     }

     $fechaActual = now()->format('Y-m-d');

    // Actualizar el estatus del automóvil según el tipo de servicio
    if ($request->tipo_servicio == 'Programado' && $request->prox_servicio == $fechaActual) {
        $automovil->estatusIn = 'Mantenimiento';  
    } elseif ($request->tipo_servicio == 'No programado' && $request->fecha_servicio == $fechaActual) {
        $automovil->estatusIn = 'En servicio';  
    } else {
        $automovil->estatusIn = 'Disponible';  
    }
 
     $automovil->save();  // Guardar cambios en el automóvil
 

    // dd($request->fecha_servicio, $request->prox_servicio, $fechaActual);


    // Crear el servicio
    $servicio = Servicios::create($input);

    return redirect()->route('servicios.index')->with('mensaje', 'Se ha creado correctamente el registro');

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
         $rules = [
             'tipo_servicio' => 'required|string|max:100',
             'descripcion' => 'nullable|string|max:255',
             'fecha_servicio' => 'nullable|date',
             'prox_servicio' => 'nullable|date',
             'costo' => 'required|numeric',
             'lugar_servicio' => 'required|string|max:255',
             'comprobante' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
             'id_automovil' => 'nullable|exists:automoviles,id_automovil',
             'estatusIn' => 'nullable|string'  // Asegúrate de validar el estatus
         ];
     
         $messages = [
             'tipo_servicio.required' => 'El campo tipo de servicio es requerido',
             'descripcion.required' => 'El campo descripción es requerido',
             'fecha_servicio.required' => 'El campo fecha de servicio es requerida',
             'prox_servicio.nullable' => 'El campo próximo servicio es opcional',
             'costo.required' => 'El campo costo es requerido',
             'lugar_servicio.required' => 'El campo lugar de servicio es requerido',
             'comprobante.nullable' => 'El campo comprobante es opcional',
             'id_automovil.exists' => 'El campo automóvil no existe'
         ];
     
         $request->validate($rules, $messages);
         $input = $request->all();
         $servicio = Servicios::findOrFail($id);
     
         // Verificar si se subió un nuevo archivo de comprobante
         if ($request->hasFile('comprobante')) {
             // Eliminar archivo anterior si existe
             if ($servicio->comprobante && file_exists(public_path('img/' . $servicio->comprobante))) {
                 unlink(public_path('img/' . $servicio->comprobante));
             }
     
             $file = $request->file('comprobante');
             $comprobante =  $file->getClientOriginalName();
             $ldate = date('Ymd_His_');
             $comprobante = $ldate . $comprobante;
     
             $file->move(public_path('img'), $comprobante);
             $input['comprobante'] = $comprobante;
         }
     
         // Actualizar el servicio
         $servicio->update($input);
     
         // Actualizar el estatus del automóvil
         $automovil = Automoviles::find($request->id_automovil);
         if ($automovil) {
             $automovil->estatusIn = $request->estatusIn;
             $automovil->save();
         }
     
         return redirect()->route('servicios.index')->with('message', 'Servicio actualizado correctamente');
     }
     
     
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $servicio = Servicios::findOrFail($id);
        $servicio->delete();
        return redirect()->route('servicios.index')->with('eliminar', 'Se ha eliminado correctamente el registro');
    }

    /**
     * Generar reporte de servicios
     */
    public function generateReport(){
        $servicios = Servicios::all();
        $pdf = FacadePdf::loadView('modulos.servicios.report-servicios', compact('servicios'));
        return $pdf->stream();  // Salida como archivo PDF

    }
}
