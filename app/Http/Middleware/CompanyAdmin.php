<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CompanyAdmin
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

        if (Auth::user()->role_id == 1 or Auth::user()->role_id == 3) {
            return $next($request);
        }
        else {
            return response()->view('message.error', ['mjs' => 'No tiene permisos para ingresar a esta sección.']);
        }

    }
}
