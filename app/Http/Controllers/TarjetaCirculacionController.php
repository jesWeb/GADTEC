<?php

namespace App\Http\Controllers;

use App\Models\TarjetaCirculacion;
use App\Models\Automoviles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TarjetaCirculacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = TarjetaCirculacion::join('automoviles as aut', 'tarjetas.id_automovil', '=', 'aut.id_automovil')
        ->select(
            'tarjetas.id_tarjeta',
            'tarjetas.nombre',
            'tarjetas.num_tarjeta',
            'tarjetas.vehiculo_origen',
            'tarjetas.fecha_expedicion',
            'tarjetas.fecha_vigencia',
            'tarjetas.estatus',
            \DB::raw("CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil")
        )
        ->whereNull('tarjetas.deleted_at'); 

        // Búsqueda dinámica
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tarjetas.nombre', 'LIKE', "%{$search}%")
                    ->orWhere('tarjetas.num_tarjeta', 'LIKE', "%{$search}%")
                    ->orWhere('tarjetas.vehiculo_origen', 'LIKE', "%{$search}%")
                    ->orWhere('tarjetas.estatus', 'LIKE', "%{$search}%")
                    ->orWhere('aut.marca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.submarca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.modelo', 'LIKE', "%{$search}%");
            });
        }

        // Paginación 
        $tarjetas = $query->paginate(10)->appends($request->query()); 

        return view('catalogos.tarjetas.index', compact('tarjetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

//     SELECT aut.*, asi.id_asignacion
// FROM automoviles AS aut
// LEFT JOIN (
//     SELECT id_automovil, id_asignacion, deleted_at
//     FROM asignacions
//     WHERE (id_automovil, id_asignacion) IN (
//         SELECT id_automovil, MAX(id_asignacion)
//         FROM asignacions
//         GROUP BY id_automovil
//     )
// ) AS asi
// ON aut.id_automovil = asi.id_automovil
// WHERE aut.deleted_at IS NULL
//   AND (asi.id_asignacion IS NULL OR asi.deleted_at IS NOT NULL)
// ORDER BY aut.marca;
    {
        $automoviles = \DB::select("SELECT aut.id_automovil, aut.marca, aut.modelo, aut.submarca
        FROM automoviles
        AS aut LEFT JOIN tarjetas AS tar ON tar.id_automovil = aut.id_automovil
        WHERE aut.deleted_at IS NULL AND(tar.id_automovil IS NULL
        OR tar.deleted_at IS NOT NULL OR tar.estatus != 'vigente')");

        return view('catalogos.tarjetas.add', compact('automoviles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:100',
            'num_tarjeta' => 'required|string|max:50|unique:tarjetas',
            'vehiculo_origen' => 'required|string|max:100',
            'fecha_expedicion' => 'required|date',
            'fecha_vigencia' => 'required|date|after:fecha_expedicion',
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'fotografia_frontal' => 'nullable|array|max:5',
            'fotografia_frontal.*' => 'file|mimes:jpeg,png,jpg'
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
            'num_tarjeta.required' => 'El campo número de tarjeta es requerido',
            'vehiculo_origen.required' => 'El campo vehículo origen es requerido',
            'fecha_expedicion.required' => 'La fecha de expedición es requerida',
            'fecha_vigencia.required' => 'La fecha de vigencia es requerida',
            'id_automovil.required' => 'El campo automóvil es requerido',
        ];

        // dd($request->all());
        $request->validate($rules, $messages);

        $input = $request->all();

        // // Guardar fotografía frontal
        // if ($request->hasFile('fotografia_frontal')) {
        //     $file = $request->file('fotografia_frontal');
        //     $imgFrontal = $file->getClientOriginalName();
        //     $ldate = date('Ymd_His_');
        //     $imgFrontal = $ldate . $imgFrontal;

        //     $file->move(public_path('img/tarjetas'), $imgFrontal);
        //     $input['fotografia_frontal'] = $imgFrontal;
        // }


         //guardar fotos
         $fotografias = [];
         $maxTotalSize = 50 * 1024 * 1024; // 50 MB
         $totalSize = 0;

         if ($request->hasFile('fotografia_frontal')) {
             $files = $request->file('fotografia_frontal');
             $files = array_slice($files, 0, 5); // Limitar a 5 fotos

             foreach ($files as $file) {
                 $totalSize += $file->getSize();
                 if ($totalSize > $maxTotalSize) {
                     return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                 }

                 // Guardar el archivo en el directorio público
                 $imgVerificacion = date('Ymd_His_') . $file->getClientOriginalName();
                 $file->move(public_path('img/tarjetas'), $imgVerificacion);
                 $fotografias[] = $imgVerificacion;
             }
         }

         //$input Guardar en json la imagen
         $input['fotografia_frontal'] = json_encode($fotografias);

        TarjetaCirculacion::create($input);



        return redirect()->route('tarjetas.index')->with('mensaje', 'Se ha creado correctamente el registro');


    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $tarjeta = TarjetaCirculacion::findOrFail($id);
    //     return view('catalogos.tarjetas.show', compact('tarjeta'));
    // }
    public function show($id)
    {
    
        $tarjeta = TarjetaCirculacion::with('automovil')->findOrFail($id);

    
        if (is_null($tarjeta->automovil)) {
        
            return view('catalogos.tarjetas.show', [
                'tarjeta' => $tarjeta,
                'mensaje' => 'El automóvil relacionado ha sido eliminado.',
            ]);
        }

        return view('catalogos.tarjetas.show', compact('tarjeta'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarjeta = TarjetaCirculacion::findOrFail($id);
        $automoviles = Automoviles::all();
        return view('catalogos.tarjetas.edit', compact('tarjeta', 'automoviles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $tarjeta = TarjetaCirculacion::findOrFail($id);
        $rules = [
            'nombre' => 'required|string|max:100',
            'num_tarjeta' => 'required|string|max:50|unique:tarjetas,num_tarjeta,' . $tarjeta->id_tarjeta,
            'vehiculo_origen' => 'required|string|max:100',
            'fecha_expedicion' => 'required|date',
            'fecha_vigencia' => 'required|date|after:fecha_expedicion',
            'estatus' => 'required|in:Vigente,Expirada,Suspendida',
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'fotografia_frontal' => 'nullable|image|mimes:jpeg,png,jpg'
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
            'num_tarjeta.required' => 'El campo número de tarjeta es requerido',
            'vehiculo_origen.required' => 'El campo vehículo origen es requerido',
            'fecha_expedicion.required' => 'La fecha de expedición es requerida',
            'fecha_vigencia.required' => 'La fecha de vigencia es requerida',
            'estatus.required' => 'El campo estatus es requerido',
            'id_automovil.required' => 'El campo automóvil es requerido',
            'fotografia_frontal.image' => 'El campo fotografía frontal debe ser una imagen',
            'fotografia_frontal.mimes' => 'El campo fotografía frontal solo puede contener imágenes en formato JPEG, PNG, JPG',
            'fotografia_frontal.max' => 'El campo fotografía frontal no puede superar los 2MB',
        ];

        $input = $request->all();

       // Manejo de imágenes
        $fotografias = $tarjeta->fotografia_frontal ? json_decode($tarjeta->fotografia_frontal, true) : [];

        $maxTotalSize = 50 * 1024 * 1024; // 50 MB
        $totalSize = 0;

        if ($request->hasFile('fotografia_frontal')) {
            $files = $request->file('fotografia_frontal');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                // Guardar el archivo en el directorio público
                $imgFrontal = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/tarjetas'), $imgFrontal);
                $fotografias[] = $imgFrontal;
            }
        }

        $input['fotografia_frontal'] = json_encode($fotografias);
        $tarjeta->update($input);

        return redirect()->route('tarjetas.index')->with('message', 'Se ha modificado correctamente el registro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarjeta = TarjetaCirculacion::findOrFail($id);
        $tarjeta->delete();
        return redirect()->route('tarjetas.index')->with('danger', 'Se ha eliminado correctamente el registro');
    }
}
