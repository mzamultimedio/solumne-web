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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('curso_id')->nullable()->constrained()->nullOnDelete();
            $table->string('alumno_nombre');
            $table->string('alumno_curso')->nullable();
            $table->date('fecha_emision');
            $table->date('fecha_pago')->nullable();
            $table->string('cuota_nro', 50)->nullable();
            $table->decimal('monto_total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
