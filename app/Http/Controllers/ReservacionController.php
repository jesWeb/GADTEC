<?php

namespace App\Http\Controllers;

use App\Models\reservaciones;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $seguros =reservaciones ::paginate(10);
        return view('catalogos.reservacion.index',compact('seguro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('catalogos.reservacion.create',compact('seguro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $Newseguro = new reservaciones();
        $Newseguro -> marca = $request->input('marca') ;
        $Newseguro -> submarca = $request->input('submarca') ;
        $Newseguro -> modelo = $request->input('modelo') ;
        $Newseguro -> motor = $request->input('motor') ;
        $Newseguro -> combustible = $request->input('combustible') ;
        $Newseguro -> Kilometraje = $request->input('kilometraje') ;
        $Newseguro -> placas = $request->input('placas') ;
        $Newseguro -> NSI = $request->input('NSI') ;
        $Newseguro -> uso = $request->input('uso') ;
        $Newseguro -> responsable= $request->input('responsable') ;
        $Newseguro -> serie= $request->input('serie') ;
        // $Newauto ->  = $request->input('marca') ;
        $Newseguro -> save();
        return to_route('reservaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
