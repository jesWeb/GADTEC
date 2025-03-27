<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios; 
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user(); 
        return view('perfil.index', compact('usuario'));
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
        //
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
    public function update(Request $request, $id)
    {
        $usuario = Auth::user();

        if ($usuario->id_usuario != $id) {
            abort(403, 'No tienes permiso para actualizar este perfil.');
        }

        $request->validate([
            'nombre' => 'required|string|max:50',
            'app' => 'required|string|max:70',
            'apm' => 'nullable|string|max:70',
            'fn' => 'required|date',
            'sex' => 'required|in:Femenino,Masculino',
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg', 
        ]);

        $input = $request->only([
            'nombre', 
            'app', 
            'apm', 
            'fn', 
            'sex', 
            'email', 
            'num_licencia'
        ]);

        // Manejo de la foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $img2 = date('Ymd_His_') . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/usuarios'), $img2);

           if ($usuario->foto && $usuario->foto != "shadow.png") {
                $oldImagePath = public_path('img/usuarios/' . $usuario->foto);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
           }

            $input['foto'] = $img2;
        }

        $usuario->update($input);

        return redirect()->route('perfil.user', $usuario->id_usuario)->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function eliminarFoto($id)
    {
        $usuario = Auth::user();
        if ($usuario->id_usuario != $id) {
            abort(403, 'No tienes permiso para eliminar esta foto.');
        }

        // Eliminar la imagen actual si no es la predeterminada
        if ($usuario->foto && $usuario->foto != "shadow.png") {
            $oldImagePath = public_path('img/usuarios/' . $usuario->foto);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Asignar imagen predeterminada
        $usuario->update(['foto' => 'shadow.png']);

        return back()->with('success', 'Foto de perfil eliminada.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    
}
