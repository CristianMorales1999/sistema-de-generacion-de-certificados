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
        Schema::create('font_configurations', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' como UNSIGNED BIGINT y la clave primaria

            // Definir las claves foráneas con las acciones correspondientes
            $table->foreignId('font_id')
                  ->constrained('fonts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade'); // Clave foránea para 'font_id'

            $table->foreignId('font_size_id')
                  ->constrained('font_sizes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade'); // Clave foránea para 'font_size_id'

            $table->foreignId('font_style_id')
                  ->constrained('font_styles')
                  ->onDelete('cascade')
                  ->onUpdate('cascade'); // Clave foránea para 'font_style_id'

            $table->foreignId('start_color_id')
                  ->constrained('colors')
                  ->onDelete('cascade')
                  ->onUpdate('cascade'); // Clave foránea para 'start_color_id'

            $table->foreignId('end_color_id')->nullable()
                  ->constrained('colors')
                  ->onDelete('cascade')
                  ->onUpdate('cascade'); // Clave foránea para 'end_color_id' (nullable)

            // No es necesario definir índices manualmente para las claves foráneas ya que Laravel lo maneja automáticamente.

            // Crea las columnas de fecha de creación y actualización
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' como TIMESTAMP NULL

            $table->index(['font_id', 'font_size_id']); // Crear un índice compuesto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('font_configurations');
    }
};
