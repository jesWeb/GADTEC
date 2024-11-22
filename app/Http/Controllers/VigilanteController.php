<?php
namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\asignacion; 
use App\Models\Automoviles;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class VigilanteController extends Controller
{
    // Mostrar la bitácora de asignaciones
    public function index()
    {
        $vigilante = asignacion::with(['automovil', 'usuarios', 'checkIns'])->get();
        return view('vigilante.index', compact('vigilante'));
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $asignacion = asignacion::findOrFail($id); // Obtener la asignación por ID
        $automoviles = Automoviles::all(); // Obtener todos los automóviles
        $usuarios = Usuarios::all(); // Obtener todos los usuarios

        return view('vigilante.edit', compact('asignacion', 'automoviles', 'usuarios'));
    }

    // Mostrar el formulario de edición 2
    public function edit2($id)
    {
        $asignacion = asignacion::findOrFail($id); // Obtener la asignación por ID
        $automoviles = Automoviles::all(); // Obtener todos los automóviles
        $usuarios = Usuarios::all(); // Obtener todos los usuarios

        return view('vigilante.edit2', compact('asignacion', 'automoviles', 'usuarios'));
    }

    public function update(Request $request, $id_asignacion)
    {
        // Validar la entrada
        $request->validate([
            'km_salida' => 'required|numeric',
            'combustible_salida' => 'required|string',
            'hora_salida' => 'nullable|date_format:H:i',
        
        ]);
    
        // Obtener la asignación
        $asignacion = asignacion::findOrFail($id_asignacion);
    
        // Crear un nuevo check-in
        $checkIn = new CheckIn();
        $checkIn->km_salida = $request->km_salida;
        $checkIn->combustible_salida = $request->combustible_salida;
        $checkIn->hora_salida = $request->hora_salida;

        // Relacionar el check-in con la asignación
        $asignacion->checkIns()->save($checkIn);
    
        return redirect()->route('vigilante.index')->with('success', 'Check-In creado exitosamente.');
    }

  public function update2(Request $request, $id_check)
{
    $request->validate([
        'km_llegada' => 'nullable|numeric',
        'combustible_llegada' => 'nullable|string',
        'hora_llegada' => 'nullable|date_format:H:i',
    ]);

    // Obtener el check-in existente
    $checkIn = CheckIn::findOrFail($id_check);

    // Actualizar los campos de llegada
    $checkIn->km_llegada = $request->km_llegada;
    $checkIn->combustible_llegada = $request->combustible_llegada;
    $checkIn->hora_llegada = $request->hora_llegada;

    // Asignar la fecha de llegada si aún no está establecida
    if (!$checkIn->fecha_llegada) {
        $checkIn->fecha_llegada = now();
    }

    // Guardar los cambios en el registro existente
    $checkIn->save();

    return redirect()->route('vigilante.index')->with('success', 'Check-In actualizado exitosamente.');
}

    
    
    

}
