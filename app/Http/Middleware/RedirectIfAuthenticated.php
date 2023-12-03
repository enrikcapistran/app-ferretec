<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($request)
    {
        if (Auth::check()) {
            // Obtener los roles del usuario autenticado
            $roles = Auth::user()->roles->pluck('nombre')->toArray();

            // Redirigir según el rol
            if (in_array('admin', $roles)) {
                return route('admin.dashboard');
            } elseif (in_array('cliente', $roles)) {
                return route('welcome');
            }
        }

        return route('welcome');
    }

    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
    // ...

    
}

