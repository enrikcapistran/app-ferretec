<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Usuario;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (auth()->check() && auth()->user()->isAdmin()) {
            // Si es un administrador, permite el acceso normalmente
            return $next($request);
        }

        // Si el usuario no es un administrador, redirige al sitio inicial
        return redirect('/');
    }
}
