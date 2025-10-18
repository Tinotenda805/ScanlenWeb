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
        Schema::create('judgement_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judgement_id')->constrained('judgements')->onDelete('cascade');
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('downloaded_at');
            $table->index(['judgement_id', 'downloaded_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judgement_downloads');
    }
};
