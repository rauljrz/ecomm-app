<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 'Unauthenticated';
        $userName = $user ? $user->name : 'Unauthenticated';
        $clientIp = $request->ip();

        $logMessage = sprintf(
            '[%s] User: %s (%s) %s accessed %s %s',
            $clientIp,
            $userName,
            $userId,
            $request->method(),
            $request->fullUrl()
        );

        Log::channel('crud')->info($logMessage);

        return $next($request);
    }
}