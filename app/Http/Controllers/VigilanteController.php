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
        // $vigilante = asignacion::with(['automovil', 'usuarios', 'checkIns'])->get();
        $vigilante = asignacion::with(['automovil', 'usuarios', 'checkIns'])
            ->where('estatus', '!=', 'reservado')
            ->get();
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
            'fotografias_salida' => 'nullable|array|max:20',
            'fotografias_salida.*' => 'file|mimes:jpeg,png,jpg',
        ]);

        // Obtener la asignación
        $asignacion = asignacion::findOrFail($id_asignacion);

        // Actualizar la hora de salida en la asignación
        $asignacion->hora_salida = $request->hora_salida;
        $asignacion->fecha_estimada_dev = $request->fecha_estimada_dev;

        // Cambiar el estatus de la asignación a "ocupado"
        $asignacion->estatus = 'ocupado';
        $asignacion->save();

        // Crear un nuevo check-in
        $checkIn = new CheckIn();
        $checkIn->km_salida = $request->km_salida;
        $checkIn->combustible_salida = $request->combustible_salida;
        $checkIn->hora_salida = $request->hora_salida;

        // Manejo de las fotografías
        $fotografias = [];
        $maxTotalSize = 75 * 1024 * 1024; //  maximo a 75 MB
        $totalSize = 0;

        if ($request->hasFile('fotografias_salida')) {
            $files = $request->file('fotografias_salida');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 30 MB.');
                }

                // Guardar el archivo en el directorio público
                $imgIn = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/salidas'), $imgIn);
                $fotografias[] = $imgIn;
            }
        }

        // Guardar las imágenes en formato JSON
        $checkIn['fotografias_salida'] = json_encode($fotografias);

        // Relacionar el check-in con la asignación
        $asignacion->checkIns()->save($checkIn);

        // Redirigir según el rol del usuario
        if (auth()->user()->hasRole('Administrador')) {
            return redirect()->route('vigilante.index')->with('success', 'Check-In actualizado exitosamente.');
        } else {
            return redirect()->route('moderador.vigilante');
        }
    }


    public function update2(Request $request, $id_check)
    {
        // Validar la entrada
        $request->validate([
            'km_llegada' => 'nullable|numeric',
            'combustible_llegada' => 'nullable|string',
            'fotografias_regreso' => 'nullable|array|max:20',
            'fotografias_regreso.*' => 'file|mimes:jpeg,png,jpg', // Máximo 10 MB por archivo
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

        // Obtener la asignación relacionada
        $asignacion = $checkIn->asignacion;
        if ($asignacion) {
            $asignacion->fecha_estimada_dev = $request->fecha_estimada_dev;
            $asignacion->estatus = 'disponible';
            $asignacion->save();
        }

        // Cambiar el estatus del automóvil
        if ($asignacion && $asignacion->automovil) {
            $asignacion->automovil->estatusIn = 'disponible';
            $asignacion->automovil->save();
        }

        // Manejo de las fotografías
        $fotografias = [];
        $maxTotalSize = 75 * 1024 * 1024; // 75 MB
        $totalSize = 0;

        if ($request->hasFile('fotografias_regreso')) {
            $files = $request->file('fotografias_regreso');
            $files = array_slice($files, 0, 5); // Limitar a 5 fotos

            foreach ($files as $file) {
                $totalSize += $file->getSize();
                if ($totalSize > $maxTotalSize) {
                    return back()->with('error', 'El tamaño total de las imágenes supera los 50 MB.');
                }

                // Guardar el archivo
                $imgIn = date('Ymd_His_') . $file->getClientOriginalName();
                $file->move(public_path('img/llegadas'), $imgIn);
                $fotografias[] = $imgIn;
            }
        }

        // Guardar las imágenes en formato JSON
        $checkIn->fotografias_regreso = json_encode($fotografias);

        // Guardar los cambios en el check-in
        $checkIn->save();

        // Redirigir según el rol del usuario
        if (auth()->user()->hasRole('Administrador')) {
            return redirect()->route('vigilante.index')->with('success', 'Check-In actualizado exitosamente.');
        } else {
            return redirect()->route('moderador.vigilante');
        }
    }
    public function show(string $id)
    {
        // Obtener la asignación por su ID
        $asignacion = asignacion::findOrFail($id);

        // Obtener la asignación con las relaciones de automovil, usuarios y checkIns
        $vigilante = asignacion::with(['automovil', 'usuarios', 'checkIns'])->findOrFail($id);

        // Pasar la variable $vigilante a la vista 'modulos.servicios.show'
        return view('vigilante.show', compact('vigilante'));
    }
}
