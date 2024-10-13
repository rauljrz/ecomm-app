# ecomm-app

Este proyecto es una aplicación de comercio electrónico desarrollada con Laravel 11, que implementa un CRUD básico para productos con control de acceso basado en roles y un sistema de logging.

## Características principales

- CRUD de productos
- Sistema de autenticación y autorización basado en roles
- Logging de acciones CRUD
- Tests unitarios

## Requisitos

- Docker y Docker Compose

## Instalación

1. Clonar el repositorio:
   ```
   git clone https://github.com/rauljrz/ecomm-app.git
   cd ecomm-app
   ```

2. Construir y levantar los contenedores Docker:
   ```
   docker compose up -d --build
   ```

3. Entrar al contenedor de la aplicación:
   ```
   docker exec -it app /bin/sh
   ```

4. Dentro del contenedor, ejecutar las migraciones y seeders:
   ```
   php artisan migrate --seed
   ```

## Roles y Acceso

El sistema tiene tres niveles de usuarios, definidos en el seeder `RoleSeeder`:

- Admin
- Editor
- Viewer

Los niveles de acceso están definidos en `routes/web.php`:

- Todos los usuarios autenticados pueden ver la lista de productos y los detalles de un producto.
- Los usuarios con rol 'admin' o 'editor' pueden crear y editar productos.
- Solo los usuarios con rol 'admin' pueden eliminar productos.

## Sistema de Logging

Se implementa un sistema de logging utilizando Monolog a través de un Trait `Loggable`. Este trait registra las acciones CRUD en un archivo `crud.log` ubicado en `storage/logs`.

El formato del log incluye:
- IP del cliente
- Nombre del usuario
- ID del usuario
- Acción realizada
- Modelo afectado
- ID del modelo (si aplica)

## Ejecución de Tests

Para ejecutar los tests unitarios:

1. Entrar al contenedor de la aplicación:
   ```
   docker exec -it app /bin/sh
   ```

2. Ejecutar los tests:
   ```
   php artisan test
   ```

**Nota:** La ejecución de los tests borrará todos los datos existentes en la base de datos. Después de ejecutar los tests, deberás volver a ejecutar las migraciones y seeders si deseas restaurar los datos de ejemplo.

## Acceso a la aplicación

Una vez que el proyecto esta en funcionamiento en:

[http://ecomm-app.rauljrz.me](http://ecomm-app.rauljrz.me)

