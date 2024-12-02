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
        Schema::create('certification_group_date', function (Blueprint $table) {
            // Definir las columnas 'certification_group_id' y 'date_id' como claves foráneas
            $table->foreignId('certification_group_id')
                  ->constrained('certification_groups')  // Relación con la tabla 'certification_groups'
                  ->onDelete('cascade')   // Eliminar en cascada
                  ->onUpdate('cascade');  // Actualizar en cascada

            $table->foreignId('date_id')
                  ->constrained('dates')  // Relación con la tabla 'dates'
                  ->onDelete('cascade')   // Eliminar en cascada
                  ->onUpdate('cascade');  // Actualizar en cascada

            // Definir la clave primaria compuesta para 'certification_group_id' y 'date_id'
            $table->primary(['certification_group_id', 'date_id']);

            $table->timestamps(); // 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_group_date');
    }
};
