<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); // Crea la columna 'name' de tipo VARCHAR(255)
            $table->boolean('is_internal_position')->default(false);
            $table->timestamps();
            // Agregar un índice en 'name' si se va a utilizar en consultas frecuentes
            $table->index('name');  // Agregar un índice en 'name' para mejorar las búsquedas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
