<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $primaryKey = 'idproducto';

    public $timestamps = false;

    protected $fillable = ['producto', 'categoria', 'precio', 'stock'];

    // Permite usar {producto} en las rutas buscando por idproducto
    public function getRouteKeyName(): string
    {
        return 'idproducto';
    }
}
