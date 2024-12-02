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
        Schema::create('images', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' como UNSIGNED BIGINT y la clave primaria
            $table->foreignId('image_type_id') // Crea la columna 'image_type_id' como UNSIGNED BIGINT y define la clave foránea
                  ->constrained('image_types') // Hace la referencia a la tabla 'image_types' automáticamente con la columna 'id'
                  ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                  ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->foreignId('image_status_id') // Crea la columna 'image_status_id' como UNSIGNED BIGINT y define la clave foránea
                  ->constrained('image_statuses') // Hace la referencia a la tabla 'image_statuses' automáticamente con la columna 'id'
                  ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                  ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->string('name',255)->nullable(); // Crea la columna 'name' como VARCHAR(255) y permite NULL
            $table->string('url', 300); // Crea la columna 'url' como VARCHAR(300) y no permite NULL
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' como TIMESTAMP NULL

            // Agregar índices explícitos si las consultas se realizarán sobre estas columnas
            $table->index(['image_type_id', 'image_status_id']); // Mejor rendimiento en búsquedas combinadas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
