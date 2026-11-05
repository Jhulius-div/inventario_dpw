<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/tabla', [ProductoController::class, 'tabla'])->name('productos.tabla');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
