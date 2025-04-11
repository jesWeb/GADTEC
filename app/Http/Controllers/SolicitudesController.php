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
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Debes iniciar sesión para solicitar un vehículo.');
            }
        
            $usuario = Auth::user(); 
        
            // Validar datos
            $request->validate([
                'id_automovil' => 'required|exists:automoviles,id_automovil',
                'motivo' => 'required|string|max:255',
                'lugar' => 'required|string|max:255',
                'fecha_salida' => 'required|date',
                'hora_salida' => 'required',
                'requierechofer' => 'nullable|boolean',
                'nombre_chofer' => 'nullable|string|max:255',
            ]);
     
            // Verificar si el usuario tiene licencia cuando no requiere chofer
            if ($request->input('requierechofer') == 0 && empty($usuario->num_licencia)) {
                return redirect()->back()->with('error', "Para solicitar un vehículo sin chofer, debes registrar tu licencia.\nSi ya cuentas con una, por favor agrégala a tu perfil.");
            }
     
            // Crear la asignación
            $asignacion = asignacion::create([
                'id_automovil' => $request->id_automovil,
                'id_usuario' => Auth::user()->id_usuario, 
                'motivo' => $request->motivo,
                'lugar' => $request->lugar,
                'fecha_salida' => $request->fecha_salida,
                'hora_salida' => $request->hora_salida,
                'requierechofer' => $request->has('requierechofer') ? 1 : 0,
                'nombre_chofer' => $request->requierechofer ? $request->nombre_chofer : null,
                'no_licencia' => $usuario->num_licencia, 
                'estatus' => 'Reservado',
            ]);
        
         
            $admin = Usuarios::where('rol', 'Administrador')->first();

            if ($admin) {
                $asignacion->load(['usuarios', 'automovil']); 
                Mail::to($admin->email)->send(new SolicitudVehiculoMailable($asignacion));
            }

     
         return redirect()->route('user.dashboard')->with('mensaje', 'Solicitud registrada correctamente');
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
