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
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leccion_id')->constrained()->onDelete('cascade');
            $table->string('display_name'); // Nombre que verá el usuario, ej: "Guía de Estudio PDF"
            $table->string('file_path'); // Ruta donde se guarda el archivo
            $table->unsignedBigInteger('file_size')->nullable(); // Tamaño en bytes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};