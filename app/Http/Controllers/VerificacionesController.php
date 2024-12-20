<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\verificacion;
use Illuminate\Http\Request;

class VerificacionesController extends Controller
{

    public function index(Request $request)
    {

        $query =verificacion::with('automovil');
        // Verificar si hay una búsqueda
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_automovil', 'LIKE', "%{$search}%")
                ->orWhere('holograma', 'LIKE', "%{$search}%")
                ->orWhere('engomado', 'LIKE', "%{$search}%")
                ->orWhere('fechaV', 'LIKE', "%{$search}%")
                ->orWhereHas('automovil', function ($q) use ($search) {
                    $q->where('marca', 'LIKE', "%{$search}%")
                        ->orWhere('submarca', 'LIKE', "%{$search}%")
                        ->orWhere('modelo', 'LIKE', "%{$search}%");
                });
            });
        }
        $verificacion = $query->get();
        return view('catalogos.verificaciones.index', compact('verificacion'));
    }

    public function create()
    {
        $automoviles = Automoviles::all();
        return view('catalogos.verificaciones.create', compact('automoviles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->all();

        //calculo proxima fecha
        $ultimaFecha = \Carbon\Carbon::parse($validatedData['fechaV']);
        $proximaV = $ultimaFecha->addMonths(6);
        $input['fechaP'] = $proximaV->format('Y-m-d');

        $newVer = new verificacion();
        $newVer->id_automovil = $request->input('id_automovil');
        $newVer->holograma = $request->input('holograma');
        $newVer->engomado = $request->input('engomado');
        $newVer->fechaV = $request->input('fechaV');
        $newVer->fechaP = $request->input('fechaP');
        $newVer->observaciones = $request->input('observaciones');

        //guardamos datos en BD
        $newVer->save();

        return redirect()->route('verificaciones.index')->with('mensaje','Se ha registrado correctamente el registro');
    }

    public function show($id)
    {
        $MostrarVer = verificacion::findOrfail($id);
        return view('catalogos.verificaciones.show', compact('MostrarVer'));
    }

    public function edit(string $id)
    {
        $EddVer = verificacion::find($id);
        $automoviles = Automoviles::all();
        return view('catalogos.verificaciones.edit', compact('EddVer','automoviles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $ultimaFecha = \Carbon\Carbon::parse($validatedData['fechaV']);
        $proximaV = $ultimaFecha->addMonths(6);
        $input['fechaP'] = $proximaV->format('Y-m-d');

        $EddVer = verificacion::findOrFail($id);
        $input = $request->all();
        $EddVer->update($input);

        return redirect()->route('verificaciones.index')->with('message',"Se ha actualizado correctamente el registro");

    }

    public function destroy($id)
    {
        //
        $DelVer = verificacion::findOrFail($id);
        $DelVer->delete();
        return redirect()->route('verificaciones.index')->with('eliminar','Se ha eliminado el registro');
    }
}
