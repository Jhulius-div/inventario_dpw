@extends('layouts.app')

@section('titulo', 'Productos')
@section('encabezado', 'Productos')

@section('contenido')

    {{-- Tabla de productos --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de productos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" id="btnNuevo">Añadir Producto +</button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-dark">
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

    {{-- Modal (sirve para añadir y editar) --}}
    <div class="modal fade" id="modalProducto" tabindex="-1">
        <div class="modal-dialog">
            <form id="formProducto" class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tituloModal">Productos</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="idproducto">

                    <div class="form-group">
                        <label for="producto">Producto:</label>
                        <input type="text" class="form-control" id="producto" placeholder="Nombre del producto">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="number" step="0.01" class="form-control" id="precio" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoría:</label>
                        <input type="text" class="form-control" id="categoria" placeholder="Categoría">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" class="form-control" id="stock" placeholder="0">
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary" id="btnGuardar">Ingresar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
$(function () {

    const urlProductos = "{{ url('/productos') }}";

    // ---------- Recargar tabla ----------
    function cargarTabla() {
        $('#tabla-productos').load(urlProductos + '/tabla');
    }

    // ---------- Abrir modal para añadir ----------
    $('#btnNuevo').on('click', function () {
        $('#formProducto')[0].reset();
        $('#idproducto').val('');
        $('#btnGuardar').text('Ingresar');
        $('#modalProducto').modal('show');
    });

    // ---------- Abrir modal para editar ----------
    $(document).on('click', '.btn-editar', function () {
        const b = $(this);
        $('#idproducto').val(b.data('id'));
        $('#producto').val(b.data('producto'));
        $('#categoria').val(b.data('categoria'));
        $('#precio').val(b.data('precio'));
        $('#stock').val(b.data('stock'));
        $('#btnGuardar').text('Actualizar');
        $('#modalProducto').modal('show');
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
                $('#modalProducto').modal('hide');
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
