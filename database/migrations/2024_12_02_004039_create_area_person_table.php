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
        Schema::create('area_person', function (Blueprint $table) {
            $table->foreignId('person_id') // Crea la columna 'person_id' como UNSIGNED BIGINT y define la clave foránea
                ->constrained('people') // Hace la referencia a la tabla 'people' automáticamente con la columna 'id'
                ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->foreignId('area_id') // Crea la columna 'area_id' como UNSIGNED BIGINT y define la clave foránea
                ->constrained('areas') // Hace la referencia a la tabla 'areas' automáticamente con la columna 'id'
                ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->date('start_date')->nullable(); // Crea la columna 'start_date' como DATE
            $table->date('end_date')->nullable(); // Crea la columna 'end_date' como DATE y permite valores NULL
            $table->boolean('is_active')->default(true); // Crea la columna 'is_activated' como BOOL y permite valores NULL
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' como TIMESTAMP NULL

            // Agregar índice compuesto en 'person_id' y 'area_id' para optimizar consultas
            $table->index(['person_id', 'area_id']); // Índice compuesto (opcional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_person');
    }
};
