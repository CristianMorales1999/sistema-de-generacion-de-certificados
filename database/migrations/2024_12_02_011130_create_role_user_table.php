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
        Schema::create('role_user', function (Blueprint $table) {
            // Definir las columnas 'user_id' y 'role_id' como claves foráneas
            $table->foreignId('user_id')
                  ->constrained('users')  // Relación con la tabla 'users'
                  ->onDelete('cascade')   // Eliminar en cascada
                  ->onUpdate('cascade');  // Actualizar en cascada

            $table->foreignId('role_id')
                  ->constrained('roles')  // Relación con la tabla 'roles'
                  ->onDelete('cascade')   // Eliminar en cascada
                  ->onUpdate('cascade');  // Actualizar en cascada

            $table->boolean('is_active')->default(true);
            // Definir la clave primaria compuesta para 'user_id' y 'role_id'
            $table->primary(['user_id', 'role_id']);

            $table->timestamps(); // Agregar los timestamps 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
