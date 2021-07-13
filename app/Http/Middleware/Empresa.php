<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Empresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id != 3) {
            return response()->view('message.error', ['mjs' => 'No tiene permisos para ingresar a esta sección solo empresas.']);
        }

        return $next($request);
    }
}