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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' como UNSIGNED BIGINT y la clave primaria
            //$table->string('name');
            $table->foreignId('person_id') // Crea la columna 'person_id' como UNSIGNED BIGINT y define la clave foránea
                  ->constrained('persons') // Hace la referencia a la tabla 'persons' automáticamente con la columna 'id'
                  ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                  ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->foreignId('user_status_id') // Crea la columna 'user_status_id' como UNSIGNED BIGINT y define la clave foránea
                  ->constrained('user_statuses') // Hace la referencia a la tabla 'user_statuses' automáticamente con la columna 'id'
                  ->onDelete('cascade') // Define la acción ON DELETE CASCADE
                  ->onUpdate('cascade'); // Define la acción ON UPDATE CASCADE

            $table->string('email')->unique(); // Crea la columna 'email' como VARCHAR(255)
            $table->timestamp('email_verified_at')->nullable(); // Crea la columna 'email_verified_at' como TIMESTAMP y permite NULL
            $table->string('password'); // Crea la columna 'password' como VARCHAR(255)
            $table->rememberToken(); // Crea la columna 'remember_token' como VARCHAR(255) y permite NULL
            $table->boolean('is_validated')->nullable(); // Crea la columna 'is_validated' como BOOL y permite NULL
            $table->string('profile_image_url', 300)->nullable(); // Crea la columna 'profile_image_url' como VARCHAR(300) y permite NULL            
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
