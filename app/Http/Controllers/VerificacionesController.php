<?php

namespace App\Http\Controllers;

use App\Models\Automoviles;
use App\Models\verificacion;
use Illuminate\Http\Request;

class VerificacionesController extends Controller
{

    public function index()
    {

        $verificacion =verificacion::with('automovil')->get();
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

        return to_route('verificaciones.index');
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

        return to_route('verificaciones.index');

    }

    public function destroy($id)
    {
        //
        $DelVer = verificacion::findOrFail($id);
        $DelVer->delete();
        return to_route('verificaciones.index');
    }
}
