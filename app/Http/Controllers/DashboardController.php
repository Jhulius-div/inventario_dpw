<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();
        $stockTotal = Producto::sum('stock');
        $totalCategorias = Producto::distinct('categoria')->count('categoria');
        $stockBajo = Producto::where('stock', '<=', 10)->count();
        $ultimos = Producto::orderByDesc('idproducto')->take(5)->get();

        return view('dashboard', compact(
            'totalProductos',
            'stockTotal',
            'totalCategorias',
            'stockBajo',
            'ultimos'
        ));
    }
}
