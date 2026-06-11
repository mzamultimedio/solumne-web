<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('modulo_user', function (Blueprint $table) {
            $table->string('status')->default('locked')->after('user_id');
            $table->timestamp('available_from')->nullable()->after('assigned_at');
            $table->timestamp('available_until')->nullable()->after('available_from');
            $table->foreignId('released_by')->nullable()->after('available_until')->constrained('users')->nullOnDelete();
            $table->string('payment_reference')->nullable()->after('released_by');
            $table->text('notes')->nullable()->after('payment_reference');
            $table->timestamp('revoked_at')->nullable()->after('notes');

            $table->index('status');
            $table->index('available_from');
            $table->index('available_until');
        });

        DB::table('modulo_user')->update([
            'status' => DB::raw("CASE WHEN assigned_at IS NULL THEN 'locked' ELSE 'unlocked' END"),
            'available_from' => DB::raw('assigned_at'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modulo_user', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['available_from']);
            $table->dropIndex(['available_until']);

            $table->dropColumn(['revoked_at', 'notes', 'payment_reference']);
            $table->dropConstrainedForeignId('released_by');
            $table->dropColumn(['available_until', 'available_from', 'status']);
        });
    }
};
