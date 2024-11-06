<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        // $usuarios = Usuarios::all();

        // Inicializar la consulta
        $query = Usuarios::query();

        if ($request->has('search') && $request->input('search')!= '') {
            $search = $request->input('search');
            // Aplicar la búsqueda a la consulta
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('app', 'LIKE', "%{$search}%")
                    ->orWhere('apm', 'LIKE', "%{$search}%")
                    ->orWhere('fn', 'LIKE', "%{$search}%")
                    ->orWhere('empresa', 'LIKE', "%{$search}%")
                    ->orWhere('rol', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('usuario', 'LIKE', "%{$search}%");
            });
        }

        $usuarios = $query->get();
        return view('catalogos.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('catalogos.usuarios.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $rules = [
            'nombre' => 'required',
            'app' => 'required',
            'fn' => 'required',
            'rol'=> 'required',
            'email' => 'required|email',
            'usuario' => 'required',
            'pass' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
            'app.required' => 'El campo apellido paterno es requerido',
            'fn.required' => 'El campo fecha de nacimiento es requerido',
            'rol.required' => 'El campo rol es requerido',
            'email.required' => 'El campo e-mail es requerido',
            'email.email' => 'El formato del e-mail es incorrecto',
            'usuario.required' => 'El campo usuario es requerido',
            'pass.required' => 'El campo contraseña es requerido',
            'foto.image' => 'El archivo debe ser una imagen',
            'foto.mimes' => 'El archivo debe ser de tipo jpeg, png, jpg o gif',
            'foto.max' => 'El tamaño máximo de la imagen es 2MB',
        ];

        $request->validate($rules, $messages);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;


            $file->move(public_path('img'), $img2);

            $input['foto'] = $img2;
        } else {
            $input['foto'] = "shadow.png";
        }

        Usuarios::create($input);
        return redirect()->route('usuarios.index')->with('message', 'Se ha creado correctamente el registro');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $usuario = Usuarios::findOrFail($id);
        return view('catalogos.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $usuario = Usuarios::findOrFail($id);
        return view('catalogos.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $rules = [
            'nombre' => 'required',
            'app' => 'required',
            'fn' => 'required',
            'rol'=> 'required',
            'email' => 'required|email',
            'usuario' => 'required',
            'pass' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es requerido',
            'app.required' => 'El campo apellido paterno es requerido',
            'fn.required' => 'El campo fecha de nacimiento es requerido',
            'rol.required' => 'El campo rol es requerido',
            'email.required' => 'El campo e-mail es requerido',
            'email.email' => 'El formato del e-mail es incorrecto',
            'usuario.required' => 'El campo usuario es requerido',
            'pass.required' => 'El campo contraseña es requerido',
            'foto.image' => 'El archivo debe ser una imagen',
            'foto.mimes' => 'El archivo debe ser de tipo jpeg, png, jpg o gif',
            'foto.max' => 'El tamaño máximo de la imagen es 2MB',
        ];

        $request->validate($rules, $messages);

        $usuario = Usuarios::findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('foto')) {
            if ($usuario->foto && $usuario->foto != "shadow.png") {
                $oldImagePath = public_path('img/' . $usuario->foto);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Elimina la imagen anterior
                }
            }


            $file = $request->file('foto');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;


            $file->move(public_path('img'), $img2);

            $input['foto'] = $img2;
        } else {
            $input['foto'] = $usuario->foto;
        }

        $usuario->update($input);
        return redirect()->route('usuarios.index')->with('message', 'Se ha modificado correctamente el registro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $usuario = Usuarios::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('danger', 'Se ha eliminado correctamente el registro');
    }

    /**
     * Generar reporte de usuarios
     */
    // public function generateReport(){
    //     $usuarios = Usuarios::all();
    //     $pdf = FacadePdf::loadView('catalogos.usuarios.report-usuarios', compact('usuarios'));
    //     return $pdf->stream();  // Output as downloadable PDF file

    // }
}
