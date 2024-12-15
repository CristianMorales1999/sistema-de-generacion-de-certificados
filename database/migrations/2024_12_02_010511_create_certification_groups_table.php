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
        Schema::create('certification_groups', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' como UNSIGNED BIGINT y la clave primaria

            // Definir las claves foráneas con las acciones correspondientes
            $table->foreignId('certification_type_id')
                ->constrained('certification_types')
                ->onDelete('cascade')
                ->onUpdate('cascade'); // Clave foránea para 'certification_type_id'

            $table->foreignId('created_by_user_id')->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->onUpdate('cascade'); // Clave foránea para 'created_by_user_id'

            $table->foreignId('certified_by_user_id')->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->onUpdate('cascade'); // Clave foránea para 'certified_by_user_id' (nullable)

            $table->foreignId('area_id')->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->onUpdate('cascade'); // Clave foránea para 'area_id' (nullable)


            $table->string('name', 300); // Crea la columna 'name' como VARCHAR(300) y permite NULL
            $table->text('description')->nullable(); // Crea la columna 'description' como TEXT y permite NULL
            $table->date('start_date')->nullable(); // Crea la columna 'start_date' como DATE y permite NULL
            $table->date('end_date')->nullable(); // Crea la columna 'end_date' como DATE y permite NULL
            $table->date('issue_date');
            $table->boolean('is_validated')->default(false); // Crea la columna 'is_validated' como BOOL y permite NULL
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' como TIMESTAMP NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_groups');
    }
};
