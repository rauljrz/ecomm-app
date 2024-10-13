<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                background-color: #0a0a0a;
                color: #00ff00;
                font-family: 'Courier New', monospace;
            }
            .card {
                background-color: #1a1a1a;
                border: 1px solid #00ff00;
            }
            .btn-primary {
                background-color: #00ff00;
                border-color: #00ff00;
                color: #0a0a0a;
            }
            .btn-primary:hover {
                background-color: #0a0a0a;
                border-color: #00ff00;
                color: #00ff00;
            }
            .form-control {
                background-color: #1a1a1a;
                border: 1px solid #00ff00;
                color: #00ff00;
            }
            .form-control:focus {
                background-color: #0a0a0a;
                border-color: #00ff00;
                box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.25);
                color: #00ff00;
            }
        </style>
    </head>
    <body>
        <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center">
            <div class="mb-4">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-green" />
                </a>
            </div>

            <div class="card w-100" style="max-width: 400px;">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <p><strong>Administrador:</strong> admin@example.com / password</p>
                <p><strong>Editor:</strong> editor@example.com / password</p>
                <p><strong>Viewer:</strong> viewer@example.com / password</p>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>