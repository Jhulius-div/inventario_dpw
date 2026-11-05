# Sistema de Inventario (Laravel 13 + AdminLTE 3 + jQuery)

## Instalación (en tu PC, dentro de esta carpeta)
1. composer install
2. copy .env.example .env        (Windows)  |  cp .env.example .env
3. php artisan key:generate
4. Revisa en .env: DB_DATABASE=db_inventario, DB_USERNAME=root, DB_PASSWORD=
5. php artisan migrate
   - Si dice "table already exists" es porque tu base ya tiene tablas: no hace falta migrar,
     la tabla `productos` ya existe (idproducto, producto, categoria, precio, stock).
6. php artisan serve  ->  http://127.0.0.1:8000

## Estructura
- routes/web.php                              Rutas
- app/Models/Producto.php                     Modelo
- app/Http/Controllers/DashboardController    Dashboard
- app/Http/Controllers/ProductoController     CRUD (responde JSON a jQuery)
- resources/views/layouts/app.blade.php       Plantilla AdminLTE (menú, scripts)
- resources/views/dashboard.blade.php         Dashboard
- resources/views/productos/productos.blade.php  Tabla + modal + jQuery + SweetAlert
- resources/views/productos/_filas.blade.php  Filas de la tabla (@foreach)

AdminLTE, jQuery, Bootstrap y SweetAlert2 se cargan por CDN (necesita internet).
