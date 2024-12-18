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
        $sql = "SELECT
                   sin.id_siniestro,
                   sin.fecha_siniestro,
                   sin.estatus,
                   CONCAT(aut.marca, ' ', aut.submarca, ' ', aut.modelo ) AS automovil ,
						 CONCAT(resp.nombre, ' ', resp.app, ' ', resp.apm) AS usuario
                FROM
                 sinister as sin
                 JOIN
                 automoviles as aut ON sin.id_automovil = aut.id_automovil
                 JOIN
                 usuarios as resp ON sin.id_usuario = resp.id_usuario
                 where sin.deleted_at IS NULL";


        // Condiciones dinámicas para búsqueda
        $conditions = [];
        $parameters = [];

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $conditions[] = "(sin.id_siniestro LIKE :search1 OR
                            sin.fecha_siniestro LIKE :search2 OR
                            sin.estatus LIKE :search3 OR
                            mul.fecha_multa LIKE :search4 OR
                            aut.marca LIKE :search5 OR
                            aut.submarca LIKE :search6 OR
                            aut.modelo LIKE :search7 OR
                            resp.nombre LIKE :search8 OR
                            resp.app LIKE :search9 OR
                            resp.apm LIKE :search10  OR
                            )";
            $parameters = [
                'search1' => "%{$search}%",
                'search2' => "%{$search}%",
                'search3' => "%{$search}%",
                'search4' => "%{$search}%",
                'search5' => "%{$search}%",
                'search6' => "%{$search}%",
                'search7' => "%{$search}%",
                'search8' => "%{$search}%",
                'search9' => "%{$search}%",
                'search10' => "%{$search}%",
            ];
        }

        // Si hay condiciones de búsqueda, agregar al WHERE
        if (!empty($conditions)) {
            $sql .= " AND " . implode(' AND ', $conditions);
        }

        // Ejecutar la consulta SQL
        $siniestros = DB::select($sql, $parameters);



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
        //
        $ViewSini = siniestros::findOrfail($id);
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
