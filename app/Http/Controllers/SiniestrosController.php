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

        $newSin = new siniestros();
        $newSin->id_automovil = $request->input('id_automovil');
        $newSin->fecha_siniestro = $request->input('fecha_siniestro');
        $newSin->descripcion = $request->input('descripcion');
        $newSin->estatus = $request->input('estatus');
        $newSin->costo_danos_estimados = $request->input('costo_danos_estimados');
        $newSin->costo_real_danos = $request->input('costo_real_danos');
        $newSin->id_usuario = $request->input('id_usuario');
        $newSin->observaciones = $request->input('observaciones');

        //guardamos datos en BD
        $newSin->save();

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
        $input = $request->all();
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
