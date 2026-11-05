<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Si la tabla ya existe en db_inventario, no se vuelve a crear
        if (Schema::hasTable('productos')) {
            return;
        }

        Schema::create('productos', function (Blueprint $table) {
            $table->id('idproducto');
            $table->string('producto', 100);
            $table->string('categoria', 100);
            $table->decimal('precio', 10, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
