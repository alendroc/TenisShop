<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zapatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->decimal('precio', 8, 2);
            $table->string('estilo')->nullable();
            $table->string('material')->nullable();
            $table->string('color_principal')->nullable();
            $table->string('imagen_principal')->nullable();
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zapatos');
    }
};