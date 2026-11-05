@extends('layouts.app')

@section('titulo', 'Productos')

@section('contenido')

    {{-- Título y migas (como las páginas de la plantilla) --}}
    <div class="row mb-4">
        <div class="col-sm-4">
            <h4 class="page-title">Productos</h4>
        </div>
        <div class="col-sm-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Tablas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Productos</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Tabla de productos --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong class="card-title">Listado de productos</strong>
            <button type="button" class="btn btn-primary" id="btnNuevo">Añadir Producto +</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th>Productos</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-productos">
                        @include('productos._filas')
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal (sirve para añadir y editar) --}}
    <div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formProducto" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="idproducto">

                    <div class="mb-3">
                        <label for="producto" class="form-label">Producto:</label>
                        <input type="text" class="form-control" id="producto" placeholder="Nombre del producto">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="number" step="0.01" class="form-control" id="precio" placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría:</label>
                        <input type="text" class="form-control" id="categoria" placeholder="Categoría">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="number" class="form-control" id="stock" placeholder="0">
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary" id="btnGuardar">Ingresar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
$(function () {

    const urlProductos = "{{ url('/productos') }}";
    const modalEl = document.getElementById('modalProducto');

    // ---------- Modal (Bootstrap 5) ----------
    function abrirModal() {
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }

    function cerrarModal() {
        bootstrap.Modal.getOrCreateInstance(modalEl).hide();
    }

    // ---------- Recargar tabla ----------
    function cargarTabla() {
        $('#tabla-productos').load(urlProductos + '/tabla');
    }

    // ---------- Abrir modal para añadir ----------
    $('#btnNuevo').on('click', function () {
        $('#formProducto')[0].reset();
        $('#idproducto').val('');
        $('#tituloModal').text('Añadir producto');
        $('#btnGuardar').text('Ingresar');
        abrirModal();
    });

    // ---------- Abrir modal para editar ----------
    $(document).on('click', '.btn-editar', function () {
        const b = $(this);
        $('#idproducto').val(b.data('id'));
        $('#producto').val(b.data('producto'));
        $('#categoria').val(b.data('categoria'));
        $('#precio').val(b.data('precio'));
        $('#stock').val(b.data('stock'));
        $('#tituloModal').text('Editar producto');
        $('#btnGuardar').text('Actualizar');
        abrirModal();
    });

    // ---------- Guardar (crear o actualizar) ----------
    $('#formProducto').on('submit', function (e) {
        e.preventDefault();

        const id = $('#idproducto').val();
        const url = id ? urlProductos + '/' + id : urlProductos;
        const metodo = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: metodo,
            data: {
                producto: $('#producto').val(),
                categoria: $('#categoria').val(),
                precio: $('#precio').val(),
                stock: $('#stock').val()
            },
            success: function (resp) {
                cerrarModal();
                cargarTabla();
                Swal.fire('¡Buen trabajo!', resp.mensaje, 'success');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errores = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    Swal.fire({ icon: 'error', title: 'Revisa los datos', html: errores });
                } else {
                    Swal.fire('Error', 'Ocurrió un problema en el servidor.', 'error');
                }
            }
        });
    });

    // ---------- Eliminar ----------
    $(document).on('click', '.btn-eliminar', function () {
        const id = $(this).data('id');
        const nombre = $(this).data('producto');

        Swal.fire({
            title: '¿Eliminar producto?',
            text: nombre,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function (resultado) {
            if (!resultado.isConfirmed) return;

            $.ajax({
                url: urlProductos + '/' + id,
                type: 'DELETE',
                success: function (resp) {
                    cargarTabla();
                    Swal.fire('¡Buen trabajo!', resp.mensaje, 'success');
                },
                error: function () {
                    Swal.fire('Error', 'No se pudo eliminar el producto.', 'error');
                }
            });
        });
    });

});
</script>
@endsection
