<?php

namespace App\Http\Controllers;

use App\Models\verificacion;
use Illuminate\Http\Request;

class VerificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $verificacion = verificacion::all();
        return view('catalogos.verificaciones.index', compact('verificacion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $verificar = verificacion::all() ;
        return view('catalogos.verificaciones.create',compact('verificar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(verificacion $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(verificacion $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, verificacion $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(verificacion $id)
    {
        //
    }
}
