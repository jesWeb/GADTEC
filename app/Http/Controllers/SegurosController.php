<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\seguros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SegurosController extends Controller
{

    public function index(Request $request)
    {
        //
        $sql = "SELECT
                    seg.id_seguro,
                    seg.aseguradora,
                    seg.fecha_vigencia,
                    seg.estatus,
                    CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil
                FROM
                seguros AS seg
                JOIN
                automoviles AS aut ON seg.id_automovil = aut.id_automovil
                WHERE
                seg.deleted_at IS NULL";

        //busqueda dinamica
        $conditions = [];
        $parameters = [];

         if ($request->has('search') && $request->input('search') != '') {
             $search = $request->input('search');
             $conditions[] = "(seg.aseguradora LIKE :search1 OR
                               seg.fecha_vigencia LIKE :search2 OR
                               seg.estatus LIKE :search3 OR
                               aut.marca LIKE :search4 OR
                               aut.submarca LIKE :search5 OR
                               aut.modelo LIKE :search6)";
             $parameters = [
                 'search1' => "%{$search}%",
                 'search2' => "%{$search}%",
                 'search3' => "%{$search}%",
                 'search4' => "%{$search}%",
                 'search5' => "%{$search}%",
                 'search6' => "%{$search}%",
             ];
         }

        // Agregar condiciones a la consulta de busqueda
         if (!empty($conditions)) {
             $sql .= " WHERE " . implode(' AND ', $conditions);
         }

        $seguro = DB::select($sql);

        return view('catalogos.seguros.index', compact('seguro'));
    }

    public function create()
    {
        // dd($request);
        $automoviles = Automoviles::all();
        return view('catalogos.seguros.create', compact('automoviles'));
    }

    public function store(Request $request)
    {
        //  dd($request);
        $rules = [
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'aseguradora' => 'required|string',
            'cobertura' => 'required|string',
            'monto' => 'required|string',
            'fecha_vigencia' => 'required|date',
            'poliza' => 'nullable|array|max:10',
            'poliza.*' => 'file|mimes:jpeg,png,jpg,pdf',
        ];
        //validacion
        $request->validate($rules);

        //guardar fotos
        $fotografias = [];
        $maxTotalSize = 50 * 1024 * 1024; // 50 MB
        $totalSize = 0;

        if ($request->hasFile('poliza')) {
            $files = $request->file('poliza');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                // Guardar el archivo en el directorio público
                $imgPoliza = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/poliza'), $imgPoliza);
                $fotografias[] = $imgPoliza;
            }
        }

        $input = $request->all();
        //$input Guardar en json la imagen
        $input['poliza'] = json_encode($fotografias);

        //guardamos datos en BD
        seguros::create($input);

        return redirect()->route('seguros.index')->with('mensaje', 'Se ha registarado exitosamente!!');
    }

    public function show($id)
    {
        $seguroS = seguros::findOrfail($id);

        return view('catalogos.seguros.show', compact('seguroS'));
    }

    public function edit(Request $request, $id)
    {
        $EddSeg = seguros::findOrFail($id);
        $automoviles = Automoviles::all();

        return view('catalogos.seguros.edit', compact('EddSeg', 'automoviles'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([

            'poliza' => 'nullable|array|max:10',
            'poliza.*' => 'file|mimes:jpeg,png,jpg,pdf',
        ]);

        $EddSeg = seguros::findOrFail($id);
        $input = $request->all();

        //guardar fotos
        $fotografias = $EddSeg->poliza ? json_decode($EddSeg->poliza, true) : [];
        $maxTotalSize = 50 * 1024 * 1024; // 50 MB
        $totalSize = 0;

        if ($request->hasFile('poliza')) {
            $files = $request->file('poliza');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                // Guardar el archivo en el directorio público
                $imgPoliza = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/poliza'), $imgPoliza);
                $fotografias[] = $imgPoliza;
            }
        }


        //$input Guardar en json la imagen
        $input['poliza'] = json_encode($fotografias);
        $EddSeg->update($input);
        return redirect()->route('seguros.index')->with('mensajeAct', 'Se ha actualizado el Seguro');
    }

    public function destroy($id)
    {

        $DelSeg = seguros::findOrFail($id);

        $DelSeg->delete();
        return redirect()->action([SegurosController::class,'index'])->with('mensajeDel', 'Se ha eliminado Correctamente el registró');
    }
}
