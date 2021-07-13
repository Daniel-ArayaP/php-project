<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Registro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * qué es esto???
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id != 5 && Auth::user()->role_id != 1 && Auth::user()->role_id != 2) {
            return response()->view('message.error', ['mjs' => 'No tienes permisos solo usuarios registro, checkea con el admin??']);
        }

        return $next($request);
    }
}
