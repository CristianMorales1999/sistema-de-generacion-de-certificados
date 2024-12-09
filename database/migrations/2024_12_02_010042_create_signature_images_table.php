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
        Schema::create('signature_images', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' como UNSIGNED BIGINT y la clave primaria
            $table->foreignId('person_id') // Crea la columna 'person_id' como UNSIGNED BIGINT y define la clave foránea
                ->constrained('people') // Hace la referencia a la tabla 'people' automáticamente con la columna 'id'
                ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->foreignId('position_id') // Crea la columna 'position_id' como UNSIGNED BIGINT y define la clave foránea
                ->nullable() // Permite que esta columna sea NULL
                ->constrained('positions') // Hace la referencia a la tabla 'positions' automáticamente con la columna 'id'
                ->onDelete('set null') // Define la acción ON DELETE SET NULL
                ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->string('url', 300); // Crea la columna 'url' como VARCHAR(300)
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' como TIMESTAMP NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signature_images');
    }
};
