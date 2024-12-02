<?php

namespace App\Http\Controllers;

use App\Models\TeneciasRefrendos;
use App\Models\Automoviles;
use Illuminate\Http\Request;

class TeneciasRefrendosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = TeneciasRefrendos::with('automovil');

        // Verificar si hay una búsqueda
        if ($request->has('search') && $request->input('search')!= '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_automovil', 'LIKE', "%{$search}%")
                    ->orWhere('origen', 'LIKE', "%{$search}%")
                    ->orWhere('monto', 'LIKE', "%{$search}%")
                    ->orWhere('año_correspondiente', 'LIKE', "%{$search}%")
                    ->orWhere('estatus', 'LIKE', "%{$search}%")
                    ->orWhere('fecha_vencimiento', 'LIKE', "%{$search}%")
                    ->orWhereHas('automovil', function ($q) use ($search) {
                        $q->where('marca', 'LIKE', "%{$search}%")
                            ->orWhere('submarca', 'LIKE', "%{$search}%")
                            ->orWhere('modelo', 'LIKE', "%{$search}%");
                });
            });
        }
        $tenencias = $query->get();

        return view('catalogos.tenencias.index', compact('tenencias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        //
        $automoviles = Automoviles::all();
        return view('catalogos.tenencias.add', compact('automoviles'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $rules = [
            'id_automovil' =>'required',
            'fecha_pago' =>'required',
            'origen' =>'required',
            'monto' =>'required',
            'año_correspondiente' =>'required',
            'comprobante' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_automovil' =>'required'

        ];

        $messages = [
            'id_automovil.required' => 'El campo automóvil es requerido',
            'fecha_pago.required' => 'El campo fecha de pago es requerido',
            'origen.required' => 'El campo origen es requerido',
            'monto.required' => 'El campo monto es requerido',
            'año_correspondiente.required' => 'El campo año correspondiente es requerido',
            'comprobante.file' => 'El archivo debe ser una imagen',
            'comprobante.mimes' => 'El archivo debe ser de tipo jpeg, png, jpg o gif',
            'comprobate.max' => 'El tamaño máximo de la imagen es 2MB',
        ];
        $request->validate($rules, $messages);

        $input = $request->all();

        if ($request->hasFile('comprobante')) {
            $file = $request->file('comprobante');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;

            // Guarda la imagen en public/img
            $file->move(public_path('img'), $img2);

            $input['comprobante'] = $img2;
        } else {
            $input['comprobante'] = "N/A";
        }


        TeneciasRefrendos::create($input);
        return redirect()->route('tenencias.index')->with('mensaje', 'Se ha creado correctamente el registro');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tenencia = TeneciasRefrendos::findOrFail($id);
        return view('catalogos.tenencias.show', compact('tenencia'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $tenencia = TeneciasRefrendos::findOrFail($id);
        $automoviles = Automoviles::all();
        return view('catalogos.tenencias.edit', compact('tenencia', 'automoviles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $rules = [
            'id_automovil' =>'required',
            'fecha_pago' =>'required',
            'origen' =>'required',
            'monto' =>'required',
            'año_correspondiente' =>'required',
            'comprobante' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_automovil' =>'required'
        ];

        $messages = [
            'id_automovil.required' => 'El campo automóvil es requerido',
            'fecha_pago.required' => 'El campo fecha de pago es requerido',
            'origen.required' => 'El campo origen es requerido',
            'monto.required' => 'El campo monto es requerido',
            'año_correspondiente.required' => 'El campo año correspondiente es requerido',
            'comprobante.file' => 'El archivo debe ser una imagen',
            'comprobante.mimes' => 'El archivo debe ser de tipo jpeg',
            'comprobante.max' => 'El tamaño máximo de la imagen es 2MB',
        ];
        $request->validate($rules, $messages);
        $tenencia = TeneciasRefrendos::findOrFail($id);

        $input = $request->all();

        if ($request->hasFile('comprobante')) {
            $file = $request->file('comprobante');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate. $img;

            // Guarda la imagen en public/img
            $file->move(public_path('img'), $img2);

            $input['comprobante'] = $img2;
        } else {
            // Asigna "N/A" si no se ha subido un nuevo comprobante y el actual es nulo o vacío
            $input['comprobante'] = $tenencia->comprobante ?: 'N/A';
        }

        $tenencia->update($input);
        return redirect()->route('tenencias.index')->with('message', 'Se ha modificado correctamente el registro');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tenencia = TeneciasRefrendos::findOrFail($id);
        $tenencia->delete();
        return redirect()->route('tenencias.index')->with('danger', 'Se ha eliminado correctamente el registro');
    }
}
