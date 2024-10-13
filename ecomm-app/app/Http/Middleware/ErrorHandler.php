<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class ErrorHandler
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $response = $next($request);
        } catch (\Exception $e) {
            Log::error('Error en la aplicación: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['error' => 'Ha ocurrido un error en el servidor.'], 500);
            }

            return response()->view('errors.500', [], 500);
        }

        if ($response instanceof Response && $response->getStatusCode() >= 400) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Ha ocurrido un error en el servidor.'], $response->getStatusCode());
            }

            return response()->view('errors.' . $response->getStatusCode(), [], $response->getStatusCode());
        }

        return $response;
    }
}