<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios;


class IncidenciaController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Incidencia::with('usuario')->orderBy('created_at'); 
    
        if ($request->has('search') && $request->search != '') {
            $query->whereDate('created_at', '=', $request->search);
        }
    
        $incidencias = $query->paginate(10);
    
        return view('incidencias.index', compact('incidencias'));
    }
    


    public function create()
    {
        return view('incidencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string'
        ]);

        Incidencia::create([
            'id_usuario' => Auth::user()->id_usuario, 
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('incidencias.index')->with('success', 'Incidencia registrada exitosamente.');
    }

    public function show($id_incidencia)
    {
        $incidencia = Incidencia::findOrFail($id_incidencia);
    
        // Verifica que el usuario tenga acceso a esta incidencia
        if (
            auth()->user()->role !== 'Administrador' && 
            auth()->user()->role !== 'Moderador' && 
            $incidencia->id_usuario !== auth()->user()->id_usuario
        ) {
            abort(403, 'No tienes permiso para ver esta incidencia');
        }
    
        return view('incidencias.show', compact('incidencia'));
    }
    
    

}
