<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ((Auth::guard($guard)->check()) && (Auth::user()->is_locked_out == 0)) {
            if (in_array(Auth::user()->role_id, [1,2])) {
                return redirect()->route('studentHome');
            }
            if (Auth::user()->role_id == 3) {
                return redirect()->route('company');
            }
        }

        return $next($request);
    }
}
