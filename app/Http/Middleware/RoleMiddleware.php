<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request); // Permite el acceso si tiene el rol
        }

        // Si no tiene el rol adecuado, redirige al inicio o a alguna otra página
        return redirect('/');
    }
}
