@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>
    <div class="card">
        <div class="card-body">
                <div class="p-6 text-green-400">
                    <h3 class="text-xl mb-4"><i class="fas fa-shopping-cart mr-2"></i>Challenge Técnico</h3>
                    <p class="mb-4">Esta es la prueba tecnica para eComm-App desarrollada con Laravel 11, que implementa un CRUD básico para productos con control de acceso basado en roles y un sistema de logging.</p>
                    
                    <h4 class="text-lg mb-2"><i class="fas fa-users mr-2"></i>Roles de Usuario</h4>
                    <ul class="list-disc list-inside mb-4">
                        <li>Admin: Acceso total al sistema</li>
                        <li>Editor: Puede crear y editar productos</li>
                        <li>Viewer: Solo puede ver productos</li>
                    </ul>
                    
                    <h4 class="text-lg mb-2"><i class="fas fa-clipboard-list mr-2"></i>Sistema de Logging</h4>
                    <p class="mb-4">Todas las acciones CRUD se registran en un archivo log, incluyendo detalles como IP del cliente, nombre del usuario, ID del usuario, acción realizada, modelo afectado y ID del modelo.</p>
                    
                    <h4 class="text-lg mb-2"><i class="fas fa-vial mr-2"></i>Ejecución de Tests Unitarios</h4>
                    <p class="mb-4">Para ejecutar los tests unitarios, sigue estos pasos:</p>
                    <ol class="list-decimal list-inside mb-4">
                        <li>Entra al contenedor de la aplicación: <code>docker exec -it app /bin/sh</code></li>
                        <li>Ejecuta los tests: <code>php artisan test</code></li>
                    </ol>
                    <p class="text-yellow-400"><i class="fas fa-exclamation-triangle mr-2"></i>Nota: La ejecución de los tests borrará todos los datos existentes en la base de datos.</p>
                </div>
        </div>
    </div>
</div>
@endsection