<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FoxMigrate') }} - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #0a0a0a;
            color: #00ff00;
            font-family: 'Courier New', monospace;
        }
        .navbar {
            background-color: #1a1a1a;
            border-bottom: 1px solid #00ff00;
        }
        .navbar-brand, .nav-link {
            color: #00ff00 !important;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 255, 0, 0.55)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .container {
            background-color: #0f0f0f;
            border: 1px solid #00ff00;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
        }
        h1, h2, h3, h4, h5, h6 {
            color: #00ff00;
        }
        .btn-primary {
            background-color: #003300;
            border-color: #00ff00;
            color: #00ff00;
        }
        .btn-primary:hover {
            background-color: #00ff00;
            color: #000;
        }
        .form-control {
            background-color: #1a1a1a;
            border-color: #00ff00;
            color: #00ff00;
        }
        .form-control:focus {
            background-color: #0f0f0f;
            border-color: #00ff00;
            box-shadow: 0 0 0 0.25rem rgba(0, 255, 0, 0.25);
            color: #00ff00;
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">eComm-app</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Captures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Migrations</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="text-center mt-4">
        <p>&copy; {{ date('Y') }} FoxMigrate. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>