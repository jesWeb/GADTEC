<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Automovil as ModelsAutomovil;
use App\Models\r;
use Illuminate\Http\Request;

class Automovil extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard.admin.Automovil.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.admin.Automovil.create');
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
    public function show( Automovil $r)
    {
        //
        // return view('dashboard.admin.Automovil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Automovil $r)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Automovil $r)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Automovil $r)
    {
        //
    }
}
