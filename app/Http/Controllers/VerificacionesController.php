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
        $verificado = verificacion::all();
        return view('catalogos.verificaciones.index', compact('verificado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $verificacion = ;
        return view('catalogos.verificaciones.create', compact('verifiacion'));
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
