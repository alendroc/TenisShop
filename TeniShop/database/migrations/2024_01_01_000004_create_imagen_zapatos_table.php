<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagen_zapatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zapato_id')->constrained('zapatos')->onDelete('cascade');
            $table->string('url');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagen_zapatos');
    }
};