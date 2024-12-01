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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('dni',8)->nullable()->unique();
            $table->string('first_name',150);
            $table->string('last_name',150);
            $table->string('personal_email',150)->nullable()->unique();
            $table->string('institutional_email',150)->nullable()->unique();
            $table->string('phone_number',12)->nullable();
            $table->unsignedTinyInteger('gender');//0: Masculino | 1: Femenino
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
