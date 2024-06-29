<?php

namespace App\Http\Middleware;


use Closure;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->role !== $role) {
            abort(403, 'No tienes autorizacion.');
        }

        return $next($request);
    }
}

