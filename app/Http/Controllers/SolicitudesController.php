<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignacion;
use App\Models\Automoviles;
use Illuminate\Support\Facades\Mail;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Auth;
use App\Mail\SolicitudVehiculoMailable;



class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $vehiculos = Automoviles::where('uso', 'Empresarial')->get();
        return view('usuario.solicitudes', compact('vehiculos'));
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
         // Verificar si el usuario está autenticado
         if (!Auth::check()) {
             return redirect()->route('login')->with('error', 'Debes iniciar sesión para solicitar un vehículo.');
         }
         
         $usuario = Auth::user(); 
     
         // Validar los datos de la solicitud
         $request->validate([
             'id_automovil' => 'required|exists:automoviles,id_automovil',
             'motivo' => 'required|string|max:255',
             'lugar' => 'required|string|max:255',
             'fecha_hora' => 'required|date', 
             'requierechofer' => 'nullable|boolean',
             'nombre_chofer' => 'nullable|string|max:255',
         ]);
     
        
         // Obtener la fecha y hora de la solicitud
         $fechaHora = explode(' ', $request->fecha_hora);
         $fecha_salida = $fechaHora[0]; 
         $hora_salida = $fechaHora[1];
     
         // Verificar si el vehículo ya está reservado para la fecha y hora solicitada
         $existingAssignment = asignacion::where('id_automovil', $request->id_automovil)
             ->where('fecha_salida', $fecha_salida)
             ->where('hora_salida', $hora_salida)
             ->whereIn('estatus', ['Reservado', 'Autorizado'])
             ->first();
     
         if ($existingAssignment) {
             return redirect()->back()->with('error', 'El vehículo ya está reservado para esta fecha y hora.');
         }
     
         if ($request->input('requierechofer') == 0 && empty($usuario->num_licencia)) {
             return redirect()->back()->with('error', "Para solicitar un vehículo sin chofer, debes registrar tu licencia.");
         }
     
         // Crear la asignación
         $asignacion = asignacion::create([
             'id_automovil' => $request->id_automovil,
             'id_usuario' => $usuario->id_usuario, 
             'motivo' => $request->motivo,
             'lugar' => $request->lugar,
             'fecha_salida' => $fecha_salida,
             'hora_salida' => $hora_salida,
             'requierechofer' => $request->has('requierechofer') ? 1 : 0,
             'nombre_chofer' => $request->requierechofer ? $request->nombre_chofer : null,
             'no_licencia' => $usuario->num_licencia, 
             'estatus' => 'Reservado',
         ]);
     
         return redirect()->route('user.dashboard')->with('mensaje', 'Solicitud registrada correctamente');
     }
     
 
     
     public function horariosOcupados($id)
     {
        $ocupadas = Solicitud::where('id_automovil', $id)
             ->whereIn('estado', ['Autorizado', 'Reservado', 'Ocupado'])
             ->pluck('fecha_hora')
             ->map(function ($fecha) {
                 return [
                     'from' => $fecha->format('Y-m-d H:i'),
                     'to' => $fecha->addHours(1)->format('Y-m-d H:i') 
                 ];
             });
     
        return response()->json($ocupadas);
     }
     
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asignacion = asignacion::with('automovil', 'checkIns')->findOrFail($id);
    
        return view('usuario.solicitudes-show', compact('asignacion'));
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
