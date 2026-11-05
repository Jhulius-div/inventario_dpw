<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Pantalla principal de productos
    public function index()
    {
        $productos = Producto::orderBy('idproducto')->get();

        return view('productos.productos', compact('productos'));
    }

    // Devuelve solo las filas de la tabla (para refrescar con jQuery)
    public function tabla()
    {
        $productos = Producto::orderBy('idproducto')->get();

        return view('productos._filas', compact('productos'));
    }

    // Guardar producto nuevo
    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        Producto::create($datos);

        return response()->json(['mensaje' => 'Producto ingresado con éxito.']);
    }

    // Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        $producto->update($datos);

        return response()->json(['mensaje' => 'Producto actualizado con éxito.']);
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json(['mensaje' => 'Producto eliminado con éxito.']);
    }

    private function reglas(): array
    {
        return [
            'producto'  => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'precio'    => 'required|numeric|min:0',
            'stock'     => 'required|integer|min:0',
        ];
    }

    private function mensajes(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'numeric'  => 'El campo :attribute debe ser un número.',
            'integer'  => 'El campo :attribute debe ser un número entero.',
            'min'      => 'El campo :attribute no puede ser negativo.',
            'max'      => 'El campo :attribute es demasiado largo.',
        ];
    }
}
