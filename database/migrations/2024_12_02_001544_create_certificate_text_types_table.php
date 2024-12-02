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
        // Tipo: Titulo, Subtitulo, Nombre de persona , cargo, nombre de firma
        Schema::create('certificate_text_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Crea la columna 'name' de tipo VARCHAR(100)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_text_types');
    }
};
