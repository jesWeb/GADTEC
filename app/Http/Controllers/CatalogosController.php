<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('catalogos.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



}
