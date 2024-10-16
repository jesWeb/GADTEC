<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $roles = Roles::all();
        return view('catalogos.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('catalogos.roles.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Reglas de validación
        $rules = [
            'nombre' => 'required',
        ];

        // Mensajes de error personalizados
        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
        ];

        // Validar la solicitud
        $this->validate($request, $rules, $messages);

        // Obtener todos los datos de la solicitud
        $input = $request->all();
        
        // Crear un nuevo rol
        Roles::create($input);

        // Redirigir con mensaje de éxito
        return redirect('roles')->with('message', 'Se ha creado correctamente el registro');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $rol = Roles::findOrFail($id);
        return view('catalogos.roles.show')->with('rol', $rol);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $rol = Roles::findOrFail($id);
        return view('catalogos.roles.edit')->with('rol', $rol);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        // Reglas de validación
        $rules = [
            'nombre' => 'required',
        ];

        // Mensajes de error personalizados
        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
        ];

        // Validar la solicitud
        $this->validate($request, $rules, $messages);

        // Encontrar el rol a actualizar
        $rol = Roles::findOrFail($id);
        $input = $request->all();

        // Actualizar el rol
        $rol->update($input);

        // Redirigir con mensaje de éxito
        return redirect('roles')->with('info', 'Se ha actualizado el registro correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $rol = Roles::findOrFail($id);
        
        // Eliminar el rol
        $rol->delete();

        // Redirigir con mensaje de advertencia
        return back()->with('danger', 'Se ha eliminado correctamente el registro');
    }
}
