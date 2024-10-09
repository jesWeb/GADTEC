<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreRequest;
use App\Models\Automovil;
use Illuminate\Http\Request;

class AutomovilController extends Controller
{

    public function index()
    {
        //
        $autos = Automovil::paginate(10);

        return view('catalogos.Automovil.index', compact('autos'));
    }

    public function create()
    {
        //

        $auto = new Automovil();
        // dd($auto);
        return view('catalogos.Automovil.create', compact('auto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validacion = $request->validate([
            'marca' => 'required',
            'submarca' => 'required',
            'modelo' => 'required',
            'motor' => 'required',
            'combustible' => 'required',
            'kilometraje' => 'required|min:10',
            'placas' => 'required',
            'NSI' => 'required',
            'uso' => 'required',
            'responsable' => 'required',
            // 'imagenU' => 'required',
        ], [
            'marca.required' => 'Es necesario el campo',
            'submarca.required' => 'Es necesario el campo de fecha',
            'modelo.required' => 'Es necesario el campo de sexo no lo dejes vacio ',
            'motor.required' => 'Es necesario el campo de peso no lo dejes vacio ',
            'combustible.required' => 'Es necesario el campo de telefono no lo dejes vacio ',
            'kilometraje.required' => 'Es necesario el campoenfermedades de  no lo dejes vacio ',
            'placas' => 'Es necesario el campo de imagen no lo dejes vacio ',
            'NSI' => 'Es necesario el campo de imagen no lo dejes vacio ',
            'uso' => 'Es necesario el campo de imagen no lo dejes vacio ',
            'responsable' => 'Es necesario el campo de imagen no lo dejes vacio ',
        ]);

        //guardar base de datos

        $marca = $request->marca;
        $submarca = $request->submarca;
        $modelo = $request->modelo;
        $serie = $request->serie;
        $motor = $request->motor;
        $combustible = $request->combustible;
        $kilomettraje = $request->kilomettraje;
        $placas = $request->placas;
        $NSI = $request->NSI;
        $uso = $request->uso;
        $responsable = $request->responsable;

        Automovil::create([

            'marca' => $marca,
            'submarca' => $submarca,
            'modelo' => $modelo,
            'serie' => $serie,
            'motor' => $motor,
            'combustible' => $combustible,
            'kilometraje' => $kilomettraje,
            'placas' => $placas,
            'NSI' => $NSI,
            'uso' => $uso,
            'responsable' => $responsable,

            //  'idTratamiento' => $idTratamiento,

        ]);

        return back()->withErrors(['success' => 'Se han guardado correctamente los datos'])->withInput();


        // return to_route('Automovil.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $AutoView = Automovil::find($id);
        // return view('catalogos.Automovil.show',['AutoView' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
