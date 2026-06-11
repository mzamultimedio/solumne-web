<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leccion_user', function (Blueprint $table) {
            $table->primary(['leccion_id', 'user_id']);
            $table->foreignId('leccion_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // CORRECCIÓN: timestamps() crea las columnas 'created_at' y 'updated_at' que Eloquent espera.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leccion_user');
    }
};