<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\seguros;
use Illuminate\Http\Request;

class SegurosController extends Controller
{

    public function index(Request $request)
    {
        //
        $query = seguros::with('automovil');
        // Verificar si hay una búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('aseguradora', 'LIKE', "%{$search}%")
                    ->orWhere('cobertura', 'LIKE', "%{$search}%")
                    ->orWhere('fecha_vigencia', 'LIKE', "%{$search}%")
                    ->orWhere('estatus', 'LIKE', "%{$search}%")
                    ->orWhere('monto', 'LIKE', "%{$search}%")
                    ->orWhereHas('automovil', function ($q) use ($search) {
                        $q->where('marca', 'LIKE', "%{$search}%")
                            ->orWhere('submarca', 'LIKE', "%{$search}%")
                            ->orWhere('modelo', 'LIKE', "%{$search}%");
                    });
            });
        }

        $seguro = $query->get();
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


//$input Guardar en json la imagen
$input['poliza'] = json_encode($fotografias);
        $EddSeg->update($input);
        return redirect()->route('seguros.index')->with('mensajeAct', 'Se ha actualizado el Seguro');
    }

    public function destroy($id)
    {
        $DelSeg = seguros::findOrFail($id);
        $DelSeg->delete();
        return redirect()->route('seguros.index')->with('mensajeDel', 'Se ha eliminado Correctamente el registró');
    }
}
