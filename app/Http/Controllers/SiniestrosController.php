<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\siniestros;
use App\Models\Usuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SiniestrosController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('sinister as sin')
        ->join('automoviles as aut', 'sin.id_automovil', '=', 'aut.id_automovil')
        ->join('usuarios as resp', 'sin.id_usuario', '=', 'resp.id_usuario')
        ->select(
            'sin.id_siniestro',
            'sin.fecha_siniestro',
            'sin.estatus',
            DB::raw("CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo) AS automovil"),
            DB::raw("CONCAT(resp.nombre, ' ', resp.app, ' ', resp.apm) AS usuario")
        )
        ->whereNull('sin.deleted_at'); 

        // Búsqueda dinámica
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('sin.id_siniestro', 'LIKE', "%{$search}%")
                    ->orWhere('sin.fecha_siniestro', 'LIKE', "%{$search}%")
                    ->orWhere('sin.estatus', 'LIKE', "%{$search}%")
                    ->orWhere('aut.marca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.submarca', 'LIKE', "%{$search}%")
                    ->orWhere('aut.modelo', 'LIKE', "%{$search}%")
                    ->orWhere('resp.nombre', 'LIKE', "%{$search}%")
                    ->orWhere('resp.app', 'LIKE', "%{$search}%")
                    ->orWhere('resp.apm', 'LIKE', "%{$search}%");
            });
        }

        // Paginación 
        $siniestros = $query->paginate(5)->appends($request->query());

        return view('catalogos.siniestros.index', compact('siniestros'));
    }

    public function create()
    {
        $automoviles  = Automoviles::all();
        $usuarios = Usuarios::all();
        return view('catalogos.siniestros.create', compact('automoviles', 'usuarios'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'monto' => 'required|numeric|min:0',
            'porcentaje' => 'nullable|in:5,10,15',
            'aplica_deducible' => 'nullable|boolean',
            'fecha_siniestro' => 'required|date|before_or_equal:today',
            'reultado' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ];
        $messages = [
            'id_automovil' => 'Seleecciona un automovil',
            'id_usuario' => 'Selecciona un usuario',
            'monto' => 'el monto debe ser enteros y se parados por una coma',
            'fecha_siniestro' => 'La fecha del Siniesro tiene que ser anterior',
            'descripcion' => 'Ingresa Una descripcion detallada del Siniestro',
        ];
        $request->validate($rules, $messages);
        // $newSin->costo_danos_estimados =  str_replace(',', '.', $costoDano);
        // ;
        $montoSin = $request->input('monto');
        $porcentajeSin = $request->input('porcentaje');
        $aplica_deducible = $request->input('aplica_deducible') == 1 ? true : false;
        if ($aplica_deducible) {
            $operacionSin = $montoSin * ($porcentajeSin / 100);
            $resultado = $montoSin - $operacionSin;
        } else {
            $resultado = $montoSin;
        }
        $input = $request->all();
        $input['monto'] = $montoSin;
        $input['resultado'] = $resultado;
        //guardamos datos en BD
        siniestros::create($input);
        return redirect()->route('siniestros.index')->with('mensaje', 'Se ha creado Correctamente el registro');
    }


    public function show($id)
    {
     $ViewSini = siniestros::with('automovil','usuarios')->findOrfail($id);

     if (is_null(!$ViewSini->automovil || !$ViewSini->usuarios)) {
        return view('catalogos.siniestros.show', [
            'ViewSini' => $ViewSini,
            'mensaje' => 'El automóvil relacionado ha sido eliminado.',
        ]);
     }

    return view('catalogos.siniestros.show', compact('ViewSini'));
    }
    public function edit($id)
    {
        $EddSin = siniestros::find($id);
        $automoviles = Automoviles::all();
        $usuarios = Usuarios::all();
        return view('catalogos.siniestros.edit', compact('EddSin', 'automoviles', 'usuarios'));
    }
    public function update(Request $request,  $id)
    {
        $EddSin = siniestros::findOrFail($id);
        $rules = [
            'fecha_siniestro' => 'required|date|before_or_equal:today',
        ];
        $messages = [
            'fecha_siniestro' => 'La fecha del Siniesro tiene que ser anterior',
        ];
        $request->validate($rules, $messages);
        $montoSin = $request->input('monto');
        $porcentajeSin = $request->input('porcentaje');
        if ($porcentajeSin) {
            $operacionSin = $montoSin * ($porcentajeSin / 100);
            $resultado =  $operacionSin;
        } else {
            $resultado = $montoSin;
        }
        $input = $request->only(['fecha_siniestro', 'estatus', 'id_usuario', 'observaciones', 'descripcion', 'porcentaje', 'resultado']);
        $input['monto'] = $montoSin;
        $input['resultado'] = $resultado;
        $EddSin->update($input);
        return redirect()->route('siniestros.index')->with('message', 'Se ha modificado correctamente el Registro ');
    }


    public function destroy($id)
    {
        $DelSin = siniestros::findOrFail($id);
        $DelSin->delete();
        return redirect()->route('siniestros.index')->with('eliminar', 'Se ha eliminado correctamente el Registro');
    }
}
