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
        Schema::create('certificate_text_type_certification_group', function (Blueprint $table) {
            // Definir las claves foráneas
            $table->foreignId('certificate_text_type_id')
                  ->constrained('certificate_text_types')  // Relación con la tabla 'certificate_text_types'
                  ->onDelete('cascade')  // Eliminar en cascada
                  ->onUpdate('cascade')  // Actualizar en cascada
                  ->name('cert_text_type_cert_group_cert_text_type_id_fk');  // Nombre corto

                 

            $table->foreignId('certification_group_id')
                  ->constrained('certification_groups')  // Relación con la tabla 'certification_groups'
                  ->onDelete('cascade')  // Eliminar en cascada
                  ->onUpdate('cascade')  // Actualizar en cascada
                  ->name('cert_text_type_cert_group_cert_group_id_fk');  // Nombre corto

            $table->foreignId('font_configuration_id')
                  ->constrained('font_configurations')  // Relación con la tabla 'font_configurations'
                  ->onDelete('cascade')  // Eliminar en cascada
                  ->onUpdate('cascade')  // Actualizar en cascada
                  ->name('cert_text_type_cert_group_font_config_id_fk');  // Nombre corto

            // Definir la clave primaria compuesta para 'certificate_text_type_id' y 'certification_group_id'
            $table->primary(['certificate_text_type_id', 'certification_group_id']);

            $table->timestamps(); // Agrega 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_text_type_certification_group');
    }
};
