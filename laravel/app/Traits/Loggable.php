<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

trait Loggable
{
    protected function logCrudAction($action, $model, $id = null)
    {
        $user = auth()->user();
        $userId = $user ? $user->id : 'Unauthenticated';
        $userName = $user ? $user->name : 'Unauthenticated';
        $clientIp = Request::ip();

        $logMessage = sprintf(
            '[%s] User: %s (%s) %s %s%s',
            $clientIp,
            $userName,
            $userId,
            $action,
            $model,
            $id ? " with ID: $id" : ''
        );

        Log::channel('crud')->info($logMessage);
    }
}