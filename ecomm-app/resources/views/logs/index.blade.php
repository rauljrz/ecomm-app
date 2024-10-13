@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Logs del sistema</h2>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Contenido del log</h5>
                <form action="{{ route('logs.clear') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar el archivo de log?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar log</button>
                </form>
            </div>
            <pre style="max-height: 500px; overflow-y: auto;">
                @foreach($logLines as $line)
                    {{ $line }}
                @endforeach
            </pre>
        </div>
    </div>
</div>
@endsection