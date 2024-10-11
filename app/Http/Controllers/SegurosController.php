<?php

namespace App\Http\Controllers;

use App\Models\SegurosModel;
use Illuminate\Http\Request;

class SegurosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $seguro = SegurosModel::paginate(10);
        return view('catalogos.seguros.index',compact('seguro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $seguros = new SegurosModel();
        return view('catalogos.seguros.create',compact('seguros'));
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
