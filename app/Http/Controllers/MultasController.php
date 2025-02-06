<?php

namespace App\Http\Controllers;

use App\Models\Multas;
use App\Models\Automoviles;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;

class MultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \DB::table('multas as mul')
            ->join('automoviles as aut', 'mul.id_automovil', '=', 'aut.id_automovil')
            ->select(
                'mul.id_multa',
                'mul.estatus',
                'mul.tipo_multa',
                'mul.monto',
                'mul.fecha_multa',
                'mul.lugar',
                \DB::raw("CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil")
            )
            ->whereNull('mul.deleted_at');

        // busqueda
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('mul.tipo_multa', 'LIKE', "%{$search}%")
                    ->orWhere('mul.lugar', 'LIKE', "%{$search}%")
                    ->orWhere('mul.estatus', 'LIKE', "%{$search}%")
                    ->orWhere('mul.monto', 'LIKE', "%{$search}%")
                    ->orWhere('mul.fecha_multa', 'LIKE', "%{$search}%")
                    ->orWhere('aut.marca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.submarca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.modelo', 'LIKE', "%{$search}%");
                    
            });
        }

        // paginacion
        $multas = $query->paginate(10)->appends($request->query());

        return view('modulos.multas.index', compact('multas'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        //
        $automoviles = \DB::select("SELECT aut.id_automovil, aut.marca, aut.modelo, aut.submarca
        FROM automoviles
        AS aut LEFT JOIN multas AS ver ON ver.id_automovil = aut.id_automovil
        WHERE aut.deleted_at IS NULL AND aut.estatusIn = 'Disponible'");
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
            'comprobante' => 'nullable|array|max:5',
            'comprobante.*' => 'nullable|file|mimes:jpeg,png,jpg',
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
                $file->move(public_path('img/multas'), $imgAuto);
                $fotografias[] = $imgAuto;
            }
        }


        //guardar en json la img
        $input['comprobante'] = json_encode($fotografias);


        Multas::create($input);

        return redirect()->route('multas.index')->with('mensaje', 'Se ha creado correctamente el registro');


    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    //     $multa = Multas::findOrFail($id);
    //     return view('modulos.multas.show', compact('multa'));

    // }

    public function show($id)
    {
    
        $multa = Multas::with('automovil')->findOrFail($id);
    
        if (is_null($multa->automovil) ) {
            return view('modulos.multas.show', [
                'multa' => $multa,
                'mensaje' => 'El automóvil o usuario relacionado ha sido eliminado.',
            ]);
        }

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


    public function update(Request $request, string $id)
{
    $rules = [
        'tipo_multa' => 'required|string|max:100',
        'monto' => 'required|numeric',
        'fecha_multa' => 'required|date',
        'lugar' => 'required|string|max:100',
        'estatus' => 'required|in:Pendiente,Pagada,Cancelada',
        'comprobante' => 'nullable|array|max:5',
        'comprobante.*' => 'nullable|file|mimes:jpeg,png,jpg',
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

    // Manejo de imágenes
    $fotografias = $multa->comprobante ? json_decode($multa->comprobante, true) : [];

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
            $file->move(public_path('img/multas'), $imgAuto);
            $fotografias[] = $imgAuto;
        }
    }
    //guardar en json la img
    $input['comprobante'] = json_encode($fotografias);

    $multa->update($input);

    return redirect()->route('multas.index')->with('message', 'Se ha modificado correctamente el registro');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $multa = Multas::find($id);

        if (!$multa) {
            return response()->json(['error' => 'Multa no encontrada'], 404);
        }
        $multa->delete();

        return redirect()->route('multas.index')->with('success', 'Multa eliminada correctamente');
    }



    /**
     * Generar reporte de multas.
     */
    public function generateReport(){
        // $multas = Multas::all();
        $multas = Multas::with('automovil')->get();
        // return view('modulos.multas.report-multas', compact('multas'));
        $pdf = FacadePdf::loadView('modulos.multas.report-multas', compact('multas'));
        return $pdf->stream();  // Salida como archivo PDF

    }

}
