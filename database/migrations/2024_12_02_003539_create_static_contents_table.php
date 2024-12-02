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
        Schema::create('static_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certification_type_id') // Crea la columna 'certification_type_id' como UNSIGNED BIGINT y define la clave foránea
                  ->constrained('certification_types') // Hace la referencia a la tabla 'certification_types' en una sola línea
                  ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                  ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE
            $table->unsignedSmallInteger('used_dates_count'); // Crea la columna 'used_dates_count' de tipo INT
            $table->text('content'); // Crea la columna 'content' de tipo TEXT
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_contents');
    }
};
