# Sistema de Inventario (Laravel 13 + plantilla ElaAdmin + jQuery)

## Instalación (en tu PC, dentro de esta carpeta)
1. composer install
2. copy .env.example .env        (Windows)  |  cp .env.example .env
3. php artisan key:generate
4. Revisa en .env: DB_DATABASE=db_inventario, DB_USERNAME=root, DB_PASSWORD=
5. php artisan migrate
   - Si dice "table already exists" es porque tu base ya tiene tablas: no hace falta migrar,
     la tabla `productos` ya existe (idproducto, producto, categoria, precio, stock).
6. php artisan serve  ->  http://127.0.0.1:8000

## Base de datos
Importa database/inventario_dev.sql en phpMyAdmin y pon DB_DATABASE=inventario_dev en el .env

## Plantilla ElaAdmin
- La plantilla ElaAdmin ya viene compilada en public/ela (ela.css, ela.js, dashboard.js, fuentes, imagenes).
  No necesitas Node ni npm para usarla. La plantilla es solo HTML/CSS/JS (Bootstrap 5); el PHP lo pone Laravel.
- Los archivos originales de la plantilla (menu lateral, barra superior, pie y dashboard) estan pasados a Blade en
  resources/views/partials/ casi sin cambios.
- Unico cambio de enlaces: en el menu lateral, Tablas -> Productos apunta a la ruta de Laravel (productos.index).
  Los demas items del menu de la plantilla quedaron con href="#" (aun no tienen pagina).

## Estructura
- routes/web.php                                  Rutas
- app/Models/Producto.php                         Modelo
- app/Http/Controllers/DashboardController        Totales del dashboard
- app/Http/Controllers/ProductoController         CRUD (responde JSON a jQuery)
- resources/views/layouts/app.blade.php           Layout: une sidebar + header + contenido + footer
- resources/views/partials/sidebar.blade.php      Menu lateral de la plantilla (Tablas > Productos)
- resources/views/partials/header|footer          Barra superior y pie de la plantilla
- resources/views/partials/dashboard-contenido    Dashboard de la plantilla (tarjetas con datos reales)
- resources/views/productos/productos.blade.php   Tabla + modal + jQuery + SweetAlert
- resources/views/productos/_filas.blade.php      Filas de la tabla (@foreach)

jQuery y SweetAlert2 se cargan por CDN (necesita internet). Los graficos del dashboard (Sales Overview, Traffic Sources)
y las tablas de abajo son contenido de ejemplo de la plantilla.
