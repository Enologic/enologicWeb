<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $allowedEmail = 'admin@admin.com';

        if (auth()->check() && auth()->user()->email == $allowedEmail) {
            return $next($request);
        }

        abort(403, 'No tienes permisos para acceder a esta página.');
    }
}
