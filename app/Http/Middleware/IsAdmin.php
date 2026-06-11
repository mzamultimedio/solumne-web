<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Comprueba si el usuario está autenticado Y si su rol es 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Si no es admin, aborta la petición con un error 403 (Acceso Prohibido)
        abort(403, 'Acción no autorizada.');
    }
}