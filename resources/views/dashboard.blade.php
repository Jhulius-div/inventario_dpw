@extends('layouts.app')

@section('titulo', 'Dashboard')
@section('encabezado', 'Dashboard')

@section('contenido')

    {{-- Tarjetas --}}
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Productos</span>
                    <span class="info-box-number">{{ $totalProductos }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-cubes"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Stock total</span>
                    <span class="info-box-number">{{ $stockTotal }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-tags"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Categorías</span>
                    <span class="info-box-number">{{ $totalCategorias }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Stock bajo (≤ 10)</span>
                    <span class="info-box-number">{{ $stockBajo }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Últimos productos --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Últimos productos</h3>
            <div class="card-tools">
                <a href="{{ route('productos.index') }}" class="btn btn-primary btn-sm">Ver productos</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ultimos as $prod)
                        <tr>
                            <td>{{ $prod->idproducto }}</td>
                            <td>{{ $prod->producto }}</td>
                            <td>{{ $prod->categoria }}</td>
                            <td>S/ {{ number_format($prod->precio, 2) }}</td>
                            <td>{{ $prod->stock }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No hay productos registrados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
