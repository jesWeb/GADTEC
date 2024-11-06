<?php

namespace App\Http\Controllers;

use App\Models\Multas;
use App\Models\Automoviles;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class MultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Multas::with('automovil');

        // Verificar si hay una búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('tipo_multa', 'LIKE', "%{$search}%")
                ->orWhere('lugar', 'LIKE', "%{$search}%")
                ->orWhere('estatus', 'LIKE', "%{$search}%")
                ->orWhere('fecha_multa', 'LIKE', "%{$search}%")
                ->orWhereHas('automovil', function ($q) use ($search) {
                    $q->where('marca', 'LIKE', "%{$search}%")
                        ->orWhere('submarca', 'LIKE', "%{$search}%")
                        ->orWhere('modelo', 'LIKE', "%{$search}%");
                });
            });
        }
        $multas = $query->get();
        return view('modulos.multas.index', compact('multas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        //
        $automoviles = Automoviles::all();
        return view('modulos.multas.add', compact('automoviles'));
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $rules = [
            'tipo_multa' => 'required|string|max:100',
            'monto' =>'required|numeric',
            'fecha_multa' =>'required|date',
            'lugar' =>'required|string|max:100',
            'estatus' =>'required|in:Pendiente,Pagada',
            'comprobante' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'observaciones' => 'nullable|string|max:255',
            'id_automovil' => 'nullable|exists:automoviles,id_automovil'
        ];

        $messages = [
            'tipo_multa.required' => 'El campo tipo de multa es requerido',
            'monto.required' => 'El campo monto es requerido',
            'fecha_multa.required' => 'La fecha de multa es requerida',
            'lugar.required' => 'El campo lugar es requerido',
            'estatus.required' => 'El campo estatus es requerido',
            'comprobante.nullable' => 'El campo comprobante es opcional',
            'observaciones.nullable' => 'El campo observaciones es opcional',
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

        Multas::create($input);

        return redirect()->route('multas.index')->with('message', 'Se ha creado correctamente el registro');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $multa = Multas::findOrFail($id);
        return view('modulos.multas.show', compact('multa'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $multa = Multas::findOrFail($id);
        $automoviles = Automoviles::all();
        return view('modulos.multas.edit', compact('multa', 'automoviles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $rules = [
        'tipo_multa' => 'required|string|max:100',
        'monto' => 'required|numeric',
        'fecha_multa' => 'required|date',
        'lugar' => 'required|string|max:100',
        'estatus' => 'required|in:Pendiente,Pagada,Cancelada',
        'comprobante' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        'observaciones' => 'nullable|string|max:255',
        'id_automovil' => 'nullable|exists:automoviles,id_automovil',
    ];

    $messages = [
        'tipo_multa.required' => 'El campo tipo de multa es requerido',
        'monto.required' => 'El campo monto es requerido',
        'fecha_multa.required' => 'La fecha de multa es requerida',
        'lugar.required' => 'El campo lugar es requerido',
        'estatus.required' => 'El campo estatus es requerido',
        'comprobante.nullable' => 'El campo comprobante es opcional',
        'observaciones.nullable' => 'El campo observaciones es opcional',
        'id_automovil.exists' => 'El campo automóvil no existe',
    ];

    $request->validate($rules, $messages);

    $multa = Multas::findOrFail($id);
    $input = $request->all();

    // Guardar comprobante
    if ($request->hasFile('comprobante')) {
        $file = $request->file('comprobante');
        $comprobante = $file->getClientOriginalName();
        $ldate = date('Ymd_His_');
        $comprobante = $ldate . $comprobante;
        $file->move(public_path('img'), $comprobante);
        $input['comprobante'] = $comprobante;
    }

    $multa->update($input);

    return redirect()->route('multas.index')->with('message', 'Se ha modificado correctamente el registro');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $multa = Multas::findOrFail($id);
        $multa->delete();
        return redirect()->route('multas.index')->with('danger', 'Se ha eliminado correctamente el registro');
    }

    /**
     * Generar reporte de multas.
     */
    public function generateReport(){
        // $multas = Multas::all();
        $multas = Multas::with('automovil')->get();
        // return view('modulos.multas.report-multas', compact('multas'));
        $pdf = FacadePdf::loadView('modulos.multas.report-multas', compact('multas'));
        return $pdf->stream();  // Output as downloadable PDF file

    }
    

    

    

}
