<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    

    public function showLoginForm()
    {
        return view('auth.login'); // Vista del formulario de login
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'pass' => 'required|string',
        ]);
    
        // Buscas al usuario por el campo 'usuario' que está único
        $usuario = Usuarios::where('usuario', $request->usuario)->first();
    
        if ($usuario && Hash::check($request->pass, $usuario->pass)) {
            // Inicia sesión con el usuario
            Auth::login($usuario);
            
            $request-> session()->put('session_rol', $usuario->rol);

            // Verifica el rol y redirige según el rol
            // if ($usuario->hasRole('Administrador')) {
            //     return redirect()->route('admin.dashboard');  // Redirige al dashboard de admin
            // } elseif ($usuario->hasRole('Moderador')) {
            //     return redirect()->route('moderator.dashboard');  // Redirige al dashboard de moderador
            // } else {
            //     return redirect()->route('user.dashboard');  // Redirige al dashboard de usuario
            // }
            $session_rol =$request->session()->get('session_rol');

            if($session_rol == 'Administrador'){  
                return redirect()->route('admin.dashboard');  // Redirige al dashboard de admin
            } elseif ($session_rol == 'Moderador') {
                return redirect()->route('moderator.dashboard');  // Redirige al dashboard de moderador
            } else {
                return redirect()->route('user.dashboard');  // Redirige al dashboard de usuario
            }
        }
    
        // Si las credenciales son incorrectas, lanza una excepción de validación
        throw ValidationException::withMessages([
            'usuario' => ['Las credenciales proporcionadas son incorrectas.'],
        ]);
    }
    
    public function logout(Request $request)
    {
        $request-> session()->forget('session_rol');
        Auth::logout();
        return redirect('/login'); // Redirige al login después de cerrar sesión
    }
}
