<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\asignacion;

class AutorizanteController extends Controller
{
    public function index(Request $request) 
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus solicitudes.');
        }

        $usuario = Auth::user();

        $query = asignacion::where('id_usuario', $usuario->id_usuario)
            ->join('automoviles', 'asignacions.id_automovil', '=', 'automoviles.id_automovil')
            ->select('asignacions.id_asignacion', 'asignacions.motivo', 'asignacions.lugar', 
                     'asignacions.fecha_salida', 'asignacions.hora_salida', 'asignacions.estatus', 
                     'automoviles.marca', 'automoviles.modelo', 'automoviles.submarca');

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('asignacions.motivo', 'LIKE', "%{$search}%")
                  ->orWhere('asignacions.fecha_salida', 'LIKE', "%{$search}%")
                  ->orWhere('asignacions.hora_salida', 'LIKE', "%{$search}%")
                  ->orWhere('asignacions.estatus', 'LIKE', "%{$search}%")
                  ->orWhere('asignacions.lugar', 'LIKE', "%{$search}%")
                  ->orWhere('automoviles.marca', 'LIKE', "%{$search}%") 
                  ->orWhere('automoviles.modelo', 'LIKE', "%{$search}%")
                  ->orWhere('automoviles.submarca', 'LIKE', "%{$search}%");
            });
        }

        $solicitudes = $query->paginate(10)->appends($request->query()); 
        
        return view('usuario.index', compact('solicitudes'));
    }
    
    public function show($id)
    {
        $userId = auth()->id();
    
        $asignacion = asignacion::where('id_asignacion', $id)
            ->where('id_usuario', $userId)
            ->with(['automovil', 'usuarios', 'checkIns'])
            ->firstOrFail();
    
        return view('usuario.show', compact('asignacion'));
    }
    
    
}
