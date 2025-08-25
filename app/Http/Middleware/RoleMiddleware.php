<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Use like: ->middleware('role:doctor') or ->middleware('role:doctor,patient')
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!in_array(Auth::user()->role, $roles, true)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
