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
        // Inicializar 
        $query = DB::table('seguros as seg')
            ->join('automoviles as aut', 'seg.id_automovil', '=', 'aut.id_automovil')
            ->select(
                'seg.id_seguro',
                'seg.aseguradora',
                'seg.fecha_vigencia',
                'seg.estatus',
                DB::raw("CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil")
            )
            ->whereNull('seg.deleted_at'); 

        // Búsqueda 
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('seg.aseguradora', 'LIKE', "%{$search}%")
                    ->orWhere('seg.fecha_vigencia', 'LIKE', "%{$search}%")
                    ->orWhere('seg.estatus', 'LIKE', "%{$search}%")
                    ->orWhere('aut.marca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.submarca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.modelo', 'LIKE', "%{$search}%");
            });
        }

        // Paginación 
        $seguro = $query->paginate(10)->appends($request->query());
        return view('catalogos.seguros.index', compact('seguro'));
    }

    public function create()
    {
        $automoviles = \DB::select("SELECT
        aut.id_automovil,
        aut.marca,
        aut.modelo,
        aut.submarca
        FROM automoviles
        AS aut LEFT JOIN seguros AS seg ON seg.id_automovil = aut.id_automovil
        WHERE aut.deleted_at IS NULL AND(seg.id_automovil IS NULL
        OR seg.deleted_at IS NOT NULL OR seg.aseguradora is NULL)
        ");
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
    
        $seguroS = seguros::with('automovil')->findOrFail($id);

    
        if (is_null($seguroS->automovil)) {
        
            return view('catalogos.seguros.show', [
                'seguroS' => $seguroS,
                'mensaje' => 'El automóvil relacionado ha sido eliminado.',
            ]);
        }

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
