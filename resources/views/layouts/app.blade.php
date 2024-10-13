<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        /* Estilos personalizados para la paginación */
        .pagination {
            margin-top: 20px;
        }
        .page-item .page-link {
            background-color: #1a1a1a;
            border-color: #00ff00;
            color: #00ff00;
        }
        .page-item.active .page-link {
            background-color: #00ff00;
            border-color: #00ff00;
            color: #0a0a0a;
        }
        .page-item.disabled .page-link {
            background-color: #1a1a1a;
            border-color: #00ff00;
            color: #006400;
        }
        .page-link:hover {
            background-color: #006400;
            border-color: #00ff00;
            color: #0a0a0a;
        }
        .nav-link.active {
            background-color: #00ff00;
            color: #0a0a0a !important;
        }
        .dropdown-menu {
            background-color: #1a1a1a;
            border: 1px solid #00ff00;
        }
        .dropdown-item {
            color: #00ff00;
        }
        .dropdown-item:hover, .dropdown-item:focus {
            background-color: #006400;
            color: #0a0a0a;
        }
        .dropdown-divider {
            border-top: 1px solid #00ff00;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <main class="container">
        @yield('content')
    </main>

    <footer class="mt-4 text-center fixed-bottom">
        <p>&copy; {{ date('Y') }} Ecomm-App. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>