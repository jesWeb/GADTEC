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

        $sql = "SELECT
        tar.id_tarjeta,
        tar.nombre,
        tar.num_tarjeta,
        tar.vehiculo_origen,
        tar.fecha_expedicion,
        tar.fecha_vigencia,
        tar.estatus,
        CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil
        FROM
            tarjetas AS tar
        JOIN
            automoviles AS aut ON tar.id_automovil = aut.id_automovil
        WHERE
            tar.deleted_at IS NULL";

        // Condiciones dinámicas para búsqueda
        $conditions = [];
        $parameters = [];

        if ($request->has('search') && $request->input('search') != '') {
        $search = $request->input('search');
        $conditions[] = "(tar.nombre LIKE :search1 OR
                        tar.num_tarjeta LIKE :search2 OR
                        tar.vehiculo_origen LIKE :search3 OR
                        tar.estatus LIKE :search4 OR
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

        // Si hay condiciones de búsqueda, agregar al WHERE
        if (!empty($conditions)) {
        $sql .= " AND " . implode(' AND ', $conditions);
        }

        // Ejecutar la consulta SQL
        $tarjetas = \DB::select($sql, $parameters);
        return view('catalogos.tarjetas.index', compact('tarjetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $automoviles = \DB::select("SELECT aut.id_automovil, aut.marca, aut.modelo, aut.submarca
        FROM automoviles
        AS aut LEFT JOIN tarjetas AS tar ON tar.id_automovil = aut.id_automovil
        WHERE (tar.id_automovil IS NULL OR tar.estatus != 'vigente')");

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
    public function show($id)
    {
        $tarjeta = TarjetaCirculacion::findOrFail($id);
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
