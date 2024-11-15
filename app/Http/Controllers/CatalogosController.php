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
                'titulo' => 'Usuarios',
                //  'label' => 'areas de usuario',
                'href' => route('usuarios.index'),
            ],
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
            [
                'titulo' => 'Tarjetas de Circulación',
                //  'label' => 'areas de usuario',
                'href' => route('tarjetas.index'),
            ],
            [
                'titulo' => 'Tenencias/Refrendos',
                //  'label' => 'areas de usuario',
                'href' => route('tenencias.index'),
            ],


        ];


        return view('catalogos.index', compact('catalogosCardsData'));
    }

    public function show($id)
    {
        
        $backRoute = route('catalogos.index'); 

        return view('catalogos.index', compact('backRoute'));
    }

}
