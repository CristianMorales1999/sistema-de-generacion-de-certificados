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
        Schema::create('certification_group_signature_image', function (Blueprint $table) {
            // Definir las columnas 'certification_group_id' y 'signature_image_id' como claves foráneas
            $table->foreignId('certification_group_id')
                  ->constrained('certification_groups')  // Relación con la tabla 'certification_groups'
                  ->onDelete('cascade')   // Eliminar en cascada
                  ->onUpdate('cascade')  // Actualizar en cascada
                  ->name('certification_group_signature_image_cert_group_id_fk');//certification_group_signature_image_certification_group_id_foreign era el nombre por defecto pero resulta que es demasiado largo por eso lo especifique

            $table->foreignId('signature_image_id')
                  ->constrained('signature_images')  // Relación con la tabla 'signature_images'
                  ->onDelete('cascade')   // Eliminar en cascada
                  ->onUpdate('cascade')  // Actualizar en cascada
                  ->name('certification_group_signature_image_sign_img_id_fk'); 

            // Definir la clave primaria compuesta para 'certification_group_id' y 'signature_image_id'
            $table->primary(['certification_group_id', 'signature_image_id']);

            $table->timestamps();  // Agrega los campos 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_group_signature_image');
    }
};
