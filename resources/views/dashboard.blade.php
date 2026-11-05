@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')
    {{-- Dashboard de la plantilla ElaAdmin (tarjetas con datos reales) --}}
    @include('partials.dashboard-contenido')
@endsection

@section('scripts')
    {{-- Gráficos de la plantilla --}}
    <script type="module" src="{{ asset('ela/dashboard.js') }}"></script>
@endsection
