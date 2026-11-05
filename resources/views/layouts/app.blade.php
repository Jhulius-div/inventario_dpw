<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Inventario') - Inventario</title>

    {{-- Estilos de la plantilla ElaAdmin --}}
    <link rel="icon" type="image/png" href="{{ asset('ela/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('ela/ela.css') }}">
</head>
<body>
<div class="wrapper">

    {{-- Menú lateral (plantilla) --}}
    @include('partials.sidebar')

    <div class="main-content">

        {{-- Barra superior (plantilla) --}}
        @include('partials.header')

        {{-- Contenido de cada pantalla --}}
        <main class="content">
            @yield('contenido')
        </main>

        {{-- Pie de página (plantilla) --}}
        @include('partials.footer')
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
<script type="module" src="{{ asset('ela/ela.js') }}"></script>

<script>
    // Token CSRF para todas las peticiones AJAX
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
</script>

@yield('scripts')
</body>
</html>
