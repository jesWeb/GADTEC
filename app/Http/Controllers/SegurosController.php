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
        //
        $automoviles = Automoviles::all();
        return view('catalogos.seguros.create', compact('automoviles'));
    }

    public function store(Request $request)
    {
        $rules = [
            'id_automovil' => 'required|exists:automoviles,id_automovil',
            'aseguradora' => 'required|string',
            'cobertura' => 'required|string',
            'monto' => 'required|string',
            'fecha_vigencia' => 'required|date',
            'poliza' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
        ];


        $request->validate($rules);
        $input = $request->all();

        //validacion de las fotos
        if ($request->hasFile('poliza')) {
            // obtener el campo file definido en el formulario
            $file = $request->file('poliza');
            // obtener el nombre dek archivo
            $img = $file->getClientOriginalName();
            //obtener fecha y hora
            $ldate = date('Ymd_His_');
            //concatena la fecha y hora con el nombre del Archivo (img)
            $img2 = $ldate . $img;
            //idicamos el nombre  y la ruta donde se almacena el archivo (img)
            $file->move(public_path('img/seguros'), $img2);
            $input['poliza'] = $img2;
        }

        // return response()->json(['success'=>$img2]);
        //guardamos datos en BD
        seguros::create($input);

        return redirect()->route('seguros.index')->with('mensaje', 'Se ha registarado exitosamente!!');
    }

    public function show($id)
    {
        $seguroS = seguros::findOrfail($id);

        return view('catalogos.seguros.show', compact('seguroS'));
    }

    public function edit($id)
    {
        $EddSeg = seguros::findOrFail($id);
        $automoviles = Automoviles::all();
        return view('catalogos.seguros.edit', compact('EddSeg', 'automoviles'));
    }

    public function update(Request $request,  $id)
    {
        $EddSeg = seguros::findOrFail($id);
        $input = $request->all();
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
