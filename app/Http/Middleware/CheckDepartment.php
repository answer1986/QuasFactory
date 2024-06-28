<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckDepartment
{
    public function handle($request, Closure $next, $department)
    {
        if (Auth::user()->department_id != $department) {
            abort(403, "No autorizado para acceder a esta sección.");
        }

        return $next($request);
    }
}
