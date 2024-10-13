<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user() || !$request->user()->hasAnyRole($roles)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Acción no autorizada.',
                    'error' => 'No tienes los permisos necesarios para realizar esta acción.'
                ], 403);
            } else {
                abort(403, 'Unauthorized action.');
            }
        }
        return $next($request);
    }
}
