<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talla_zapatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zapato_id')->constrained('zapatos')->onDelete('cascade');
            $table->decimal('talla_us', 4, 1);
            $table->decimal('talla_eu', 4, 1);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talla_zapatos');
    }
};