<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignacion;
use App\Models\Automoviles;


class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $vehiculos = Automoviles::all(); // Obtiene todos los vehículos
        return view('autorizante.solicitud.solicitudes', compact('vehiculos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_automovil' => 'required|exists:vehiculos,id',
            'fecha_salida' => 'required|date',
            'hora_salida' => 'required',
        ]);
    
        $hora_fin = date('H:i', strtotime($request->hora_salida . ' +1 hour'));
    
        $conflicto = Asignacion::where('id_automovil', $request->id_automovil)
            ->where('fecha_salida', $request->fecha_salida)
            ->where(function ($query) use ($request, $hora_fin) {
                $query->whereBetween('hora_salida', [$request->hora_salida, $hora_fin])
                      ->orWhereBetween('hora_fin', [$request->hora_salida, $hora_fin])
                      ->orWhere(function ($q) use ($request, $hora_fin) {
                          $q->where('hora_salida', '<=', $request->hora_salida)
                            ->where('hora_fin', '>=', $hora_fin);
                      });
            })
            ->exists();
    
        if ($conflicto) {
            return response()->json(['error' => 'Este horario ya está reservado.'], 409);
        }
    
        Asignacion::create([
            'id_automovil' => $request->id_automovil,
            'fecha_salida' => $request->fecha_salida,
            'hora_salida' => $request->hora_salida,
            'hora_fin' => $hora_fin,
            'estado' => 'Reservado',
        ]);
    
        return response()->json(['success' => 'Solicitud registrada con éxito.'], 201);
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
