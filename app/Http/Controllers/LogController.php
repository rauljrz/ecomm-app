<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function index()
    {
        $logPath = storage_path('logs/crud.log');
        
        if (File::exists($logPath)) {
            $logContent = File::get($logPath);
            $logLines = array_filter(array_reverse(explode("\n", $logContent)));
        } else {
            $logLines = ['No se encontró el archivo de log.'];
        }
        
        return view('logs.index', compact('logLines'));
    }

    public function clear()
    {
        $logPath = storage_path('logs/crud.log');
        
        if (File::exists($logPath)) {
            File::delete($logPath);
            return redirect()->route('logs.index')->with('success', 'El archivo de log ha sido eliminado.');
        }
        
        return redirect()->route('logs.index')->with('error', 'No se encontró el archivo de log.');
    }
}