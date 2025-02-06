<?php

namespace App\Http\Controllers;

use App\Models\TeneciasRefrendos;
use App\Models\Automoviles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TeneciasRefrendosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TeneciasRefrendos::with('automovil')
        ->whereNull('tenencias.deleted_at')
        ->join('automoviles as aut', 'tenencias.id_automovil', '=', 'aut.id_automovil') // Unir con la tabla de automóviles
        ->select(
            'tenencias.id_tenencia',
            'tenencias.fecha_pago',
            'tenencias.origen',
            'tenencias.monto',
            'tenencias.año_correspondiente',
            'tenencias.estatus',
            DB::raw("CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil")
        );

        // busqueda
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tenencias.origen', 'LIKE', "%{$search}%")
                    ->orWhere('tenencias.monto', 'LIKE', "%{$search}%")
                    ->orWhere('tenencias.año_correspondiente', 'LIKE', "%{$search}%")
                    ->orWhere('tenencias.estatus', 'LIKE', "%{$search}%")
                    ->orWhere('aut.marca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.submarca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.modelo', 'LIKE', "%{$search}%");
            });
        }

        // paginacion
        $tenencias = $query->paginate(10)->appends($request->query()); 

        
        return view('catalogos.tenencias.index', compact('tenencias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        //
        $automoviles = \DB::select("SELECT aut.id_automovil, aut.marca, aut.submarca, aut.modelo
	    FROM automoviles AS aut
	    LEFT JOIN tenencias AS ten ON ten.id_automovil = aut.id_automovil
	    WHERE aut.deleted_at IS NULL");
        // $automoviles = Automoviles::all();
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
            'comprobante' =>'nullable|array|max:5',
            'comprobante.*' =>'nullable|image|mimes:jpeg,png,jpg',
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
        ];
        $request->validate($rules, $messages);

        $input = $request->all();

        // Manejo de imágenes
        $fotografias = [];

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
                $file->move(public_path('img/tenencias'), $imgAuto);
                $fotografias[] = $imgAuto;
            }
        }

        $input = $request->all();
        //guardar en json la img
        $input['comprobante'] = json_encode($fotografias);


        TeneciasRefrendos::create($input);
        return redirect()->route('tenencias.index')->with('mensaje', 'Se ha creado correctamente el registro');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    //     $tenencia = TeneciasRefrendos::findOrFail($id);
    //     return view('catalogos.tenencias.show', compact('tenencia'));
    // }
    public function show($id)
    {
    
        $tenencia = TeneciasRefrendos::with('automovil')->findOrFail($id);

    
        if (is_null($tenencia->automovil)) {
        
            return view('catalogos.tenencias.show', [
                'tenencia' => $tenencia,
                'mensaje' => 'El automóvil relacionado ha sido eliminado.',
            ]);
        }

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
            'comprobante' =>'nullable|array|max:5',
            'comprobante.*' =>'nullable|image|mimes:jpeg,png,jpg,gif',
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
        ];
        $request->validate($rules, $messages);
        $tenencia = TeneciasRefrendos::findOrFail($id);


        // Manejo de imágenes
        $fotografias = $tenencia->comprobante ? json_decode($tenencia->comprobante, true) : [];

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
                $imgTenencia = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/tenencias'), $imgTenencia);
                $fotografias[] = $imgTenencia;
            }
        }

        $input = $request->all();
        //guardar en json la img
        $input['comprobante'] = json_encode($fotografias);

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
