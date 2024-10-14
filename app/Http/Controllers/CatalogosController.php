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
        $catalogosCardsData = [
            [
                'titulo' => 'Automoviles',
                // 'label' => 'salas cirugia',
                'href' => route('Automovil.index'),
            ],
            [
                'titulo' => 'Seguros',
                'href' => route('seguros.index')
            ],
            [
                'titulo' => 'Siniestros',
                //  'label' => 'areas de usuario',
                'href' => route('siniestros.index'),
            ],
            [
                'titulo' => 'Verficaciones',
                //  'label' => 'areas de usuario',
                'href' => route('verificaciones.index'),
            ],


        ];


        return view('catalogos.index', compact('catalogosCardsData'));
    }
}
