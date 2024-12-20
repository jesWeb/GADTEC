<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\Automoviles;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Base de la consulta SQL
        $sql = "SELECT
                    serv.id_servicio,
                    serv.tipo_servicio,
                    serv.descripcion,
                    serv.fecha_servicio,
                    serv.prox_servicio,
                    serv.costo,
                    serv.lugar_servicio,
                    serv.id_automovil,
                    aut.estatusIn,
                    CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil
                FROM
                    servicios AS serv
                JOIN
                    automoviles AS aut ON serv.id_automovil = aut.id_automovil
                WHERE
                    serv.deleted_at IS NULL";

        // Condiciones dinámicas para buscar
        $conditions = [];
        $parameters = [];

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $conditions[] = "(serv.tipo_servicio LIKE :search1 OR
                              serv.descripcion LIKE :search2 OR
                              serv.costo LIKE :search3 OR
                              serv.lugar_servicio LIKE :search4 OR
                              aut.marca LIKE :search5 OR
                              aut.submarca LIKE :search6 OR
                              aut.modelo LIKE :search7)";
            $parameters = [
                'search1' => "%{$search}%",
                'search2' => "%{$search}%",
                'search3' => "%{$search}%",
                'search4' => "%{$search}%",
                'search5' => "%{$search}%",
                'search6' => "%{$search}%",
                'search7' => "%{$search}%",
            ];
        }

        // Agregar condiciones a la consulta de busqueda
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        // Variable para visualizar en tb
        $servicios = \DB::select($sql, $parameters);


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
            'comprobante' => 'nullable|array|max:5',
            'comprobante.*' => 'nullable|file|mimes:jpeg,png,jpg',
            'id_automovil' => 'nullable|exists:automoviles,id_automovil'
        ];

        $messages = [
            'tipo_servicio.required' => 'El campo tipo de servicio es requerido',
            'lugar_servicio.required' => 'El campo lugar de servicio es requerido',
            'id_automovil.exists' => 'El campo automóvil no existe'
        ];

        $request->validate($rules, $messages);
        $input = $request->all();

        // Manejo de comprobantes
        $fotografias = [];
        $maxTotalSize = 50 * 1024 * 1024; // 50 MB
        $totalSize = 0;

        if ($request->hasFile('comprobante')) {
            $files = array_slice($request->file('comprobante'), 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                $imgAuto = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/servicios'), $imgAuto);
                $fotografias[] = $imgAuto;
            }
        }

        $input['comprobante'] = json_encode($fotografias);

        // Obtener el automóvil actualizar estatus
        $automovil = Automoviles::find($request->id_automovil);
        if ($automovil) {
            $fechaActual = now();

            if ($request->tipo_servicio === 'Programado' && $request->prox_servicio == $fechaActual->format('Y-m-d')) {
                $automovil->estatusIn = 'Mantenimiento';
            } elseif ($request->tipo_servicio === 'No programado' && $request->fecha_servicio == $fechaActual->format('Y-m-d')) {
                $automovil->estatusIn = 'En servicio';
            } else {
                $automovil->estatusIn = 'Disponible';
            }
            $automovil->save();
        }

        // Crear el servicio
        Servicios::create($input);

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
             'comprobante' => 'nullable|array|max:5',
             'comprobante.*' => 'nullable|file|mimes:jpeg,png,jpg',
             'id_automovil' => 'nullable|exists:automoviles,id_automovil',
          
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

        $fotografias = $servicio->comprobante ? json_decode($servicio->comprobante, true) : [];

        $maxTotalSize = 50 * 1024 * 1024; // 50 MB
        $totalSize = 0;

        if ($request->hasFile('comprobante')) {
            $files = $request->file('comprobante');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                // Guardar el archivo en el directorio público
                $imgAuto = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/servicios'), $imgAuto);
                $fotografias[] = $imgAuto;
            }
        }


        //guardar en json la img
        $input['comprobante'] = json_encode($fotografias);

         // Actualizar el servicio
         $servicio->update($input);

         

         return redirect()->route('servicios.index')->with('message', 'Servicio actualizado correctamente');
     }

    public function update2($id, Request $request)
    {
        $query = Automoviles::find($id);
        $query->estatusIn = 'Disponible';
        $query->save();

        // Redirigir a la vista de Gestión después de la actualización
        return redirect()->route('servicios.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    

    public function destroy($id)
    {
        $servicio = Servicios::findOrFail($id);

        if (!$servicio) {
            return response()->json(['error' => 'Serivicio no encontrado'], 404);
        }
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