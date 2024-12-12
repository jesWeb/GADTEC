<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\siniestros;
use App\Models\Usuarios;

use Illuminate\Http\Request;

class SiniestrosController extends Controller
{
    public function index(Request $request)
    {
        //
        $query = siniestros::with('automovil', 'usuarios');
        // Verificar si hay una búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('id_automovil', 'LIKE', "%{$search}%")
                    ->orWhere('fecha_siniestro', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%")
                    ->orWhere('estatus', 'LIKE', "%{$search}%")
                    ->orWhereHas('automovil', function ($q) use ($search) {
                        $q->where('marca', 'LIKE', "%{$search}%")
                            ->orWhere('submarca', 'LIKE', "%{$search}%")
                            ->orWhere('modelo', 'LIKE', "%{$search}%");
                    });
            });
        }
        $siniestros = $query->get();
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
            'fecha_siniestro' => 'La fecha del Siniesro tiene que ser anterior ',
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

        $montoSin = $request->input('monto');
        $porcentajeSin = $request->input('porcentaje');

        if ($porcentajeSin) {
            $operacionSin = $montoSin * ($porcentajeSin / 100);
            $resultado =  $operacionSin;
        } else {
            $resultado = $montoSin;
        }

        $input = $request->only(['fecha_siniestro', 'estatus', 'id_usuario', 'observaciones', 'descripcion','porcentaje','resultado']);
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
