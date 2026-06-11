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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('tipo', 50)->default('RECIBO')->after('id');
            $table->string('letra', 5)->default('X')->after('tipo');
            $table->string('forma_pago', 100)->nullable()->after('fecha_pago');

            // Emisor
            $table->string('emisor_razon_social')->nullable()->after('letra');
            $table->string('emisor_domicilio')->nullable()->after('emisor_razon_social');
            $table->string('emisor_condicion_iva')->nullable()->after('emisor_domicilio');
            $table->string('emisor_cuit', 30)->nullable()->after('emisor_condicion_iva');
            $table->string('emisor_ing_brutos', 50)->nullable()->after('emisor_cuit');
            $table->date('emisor_inicio_actividades')->nullable()->after('emisor_ing_brutos');

            // Receptor / Alumno
            $table->string('receptor_documento', 30)->nullable()->after('alumno_curso');
            $table->string('receptor_condicion_iva', 100)->nullable()->after('receptor_documento');
            $table->string('receptor_domicilio')->nullable()->after('receptor_condicion_iva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'tipo',
                'letra',
                'forma_pago',
                'emisor_razon_social',
                'emisor_domicilio',
                'emisor_condicion_iva',
                'emisor_cuit',
                'emisor_ing_brutos',
                'emisor_inicio_actividades',
                'receptor_documento',
                'receptor_condicion_iva',
                'receptor_domicilio',
            ]);
        });
    }
};
