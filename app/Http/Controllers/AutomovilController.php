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
        // $cars = Automovil::paginate(10);
        $cars = Automovil::all();

        return view('catalogos.Automovil.index', compact('cars'));
    }

    public function create()
    {
        $AutoC = Automovil::all();
    // dd($auto);
        return view('catalogos.Automovil.create',compact('AutoC'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $Newauto = new Automovil();
        $Newauto -> marca = $request->input('marca') ;
        $Newauto -> submarca = $request->input('submarca') ;
        $Newauto -> modelo = $request->input('modelo') ;
        $Newauto -> motor = $request->input('motor') ;
        $Newauto -> combustible = $request->input('combustible') ;
        $Newauto -> Kilometraje = $request->input('kilometraje') ;
        $Newauto -> placas = $request->input('placas') ;
        $Newauto -> NSI = $request->input('NSI') ;
        $Newauto -> uso = $request->input('uso') ;
        $Newauto -> responsable= $request->input('responsable') ;
        $Newauto -> serie= $request->input('serie') ;
        // $Newauto ->  = $request->input('marca') ;


        $Newauto -> save();
        // dd($Newauto);
         return to_route('Automovil.index');



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
