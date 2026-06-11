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
        Schema::create('leccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulo_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('content_type', ['video', 'text'])->default('text');
            $table->longText('content')->nullable(); // Para el texto o el enlace del video
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leccions');
    }
};