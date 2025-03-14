<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutorizanteController extends Controller
{
    public function index()
    {
        return view('usuario.index');
    }
}
