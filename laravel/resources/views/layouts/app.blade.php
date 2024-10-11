<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Ecomm-App') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .table {
            color: #00ff00;
        }
        .table thead th {
            border-bottom: 2px solid #00ff00;
        }
        .table td, .table th {
            border-top: 1px solid #00ff00;
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
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Ecomm-App') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="mt-4 text-center">
        <p>&copy; {{ date('Y') }} Ecomm-App. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>