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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();  // Crea un campo 'id' auto-incrementable
            $table->string('name', 100);  // Crea el campo 'name' de tipo VARCHAR(100)
            $table->string('description', 255)->nullable();  // Crea el campo 'description' de tipo VARCHAR(255), puede ser nulo
            $table->timestamps();  // Crea los campos 'created_at' y 'updated_at' de tipo TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
