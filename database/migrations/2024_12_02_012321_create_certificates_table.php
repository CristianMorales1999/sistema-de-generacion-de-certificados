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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();  // Crea la columna 'id' como UNSIGNED BIGINT y la clave primaria

            // Definir las claves foráneas
            $table->foreignId('person_id')
                ->constrained('people')  // Relación con la tabla 'people'
                ->onDelete('cascade')  // Eliminar en cascada
                ->onUpdate('cascade');  // Actualizar en cascada

            $table->foreignId('certification_group_id')
                ->constrained('certification_groups')  // Relación con la tabla 'certification_groups'
                ->onDelete('cascade')  // Eliminar en cascada
                ->onUpdate('cascade');  // Actualizar en cascada

            $table->foreignId('certificate_status_id')
                ->nullable()
                ->constrained('certificate_statuses')  // Relación con la tabla 'certificate_statuses'
                ->onDelete('set null')  // Set null
                ->onUpdate('cascade');  // Actualizar en cascada

            // Definir la columna 'code' como VARCHAR(100) y 'is_validated' como BOOL
            $table->string('code', 100);
            $table->boolean('is_validated')->default(false);

            // Crear las columnas 'created_at' y 'updated_at' como TIMESTAMP NULL
            $table->timestamps();

            // Definir índice único compuesto para 'person_id' y 'certification_group_id'
            $table->unique(['person_id', 'certification_group_id'], 'certificates_person_id_certification_group_id_unique');

            $table->index('code'); // Si planeas hacer consultas frecuentes con 'code'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
