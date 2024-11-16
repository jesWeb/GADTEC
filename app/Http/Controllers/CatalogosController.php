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
                'imagen' => asset('img/catalogos/users.svg')
            ],
            [
                'titulo' => 'Automoviles',
                // 'label' => 'salas cirugia',
                'href' => route('Automovil.index'),
                'imagen' => asset('img/catalogos/Automovil.svg')
            ],
            [
                'titulo' => 'Seguros',
                'href' => route('seguros.index'),
                'imagen' => asset('img/catalogos/seguros.svg')
            ],
            [
                'titulo' => 'Siniestros',
                //  'label' => 'areas de usuario',
                'href' => route('siniestros.index'),
                'imagen' => asset('img/catalogos/siniestros.svg')
            ],
            [
                'titulo' => 'Verficaciones',
                //  'label' => 'areas de usuario',
                'href' => route('verificaciones.index'),
                'imagen' => asset('img/catalogos/verificaciones.svg')
            ],
            [
                'titulo' => 'Tarjetas de Circulación',
                //  'label' => 'areas de usuario',
                'href' => route('tarjetas.index'),
                'imagen' => asset('img/catalogos/idCard2.svg')
            ],
            [
                'titulo' => 'Tenencias/Refrendos',
                //  'label' => 'areas de usuario',
                'href' => route('tenencias.index'),
                'imagen' => asset('img/catalogos/tenencias.svg')
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
