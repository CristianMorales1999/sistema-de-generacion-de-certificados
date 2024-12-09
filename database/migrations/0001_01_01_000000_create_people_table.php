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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->nullable()->unique();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('personal_email')->nullable()->unique(); // Con longitud predeterminada de 255
            $table->string('institutional_email')->nullable()->unique(); // Con longitud predeterminada de 255

            $table->string('phone_number', 15)->nullable();
            $table->enum('gender', ['masculino', 'femenino']); // Uso de enum para mayor claridad
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
