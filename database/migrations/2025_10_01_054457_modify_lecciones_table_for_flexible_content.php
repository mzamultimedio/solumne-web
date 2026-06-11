<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leccions', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('title');
            $table->longText('text_content')->nullable()->after('video_url');
            $table->dropColumn(['content', 'content_type']);
        });
    }

    public function down(): void
    {
        Schema::table('leccions', function (Blueprint $table) {
            $table->enum('content_type', ['video', 'text'])->default('text');
            $table->longText('content')->nullable();
            $table->dropColumn(['video_url', 'text_content']);
        });
    }
};