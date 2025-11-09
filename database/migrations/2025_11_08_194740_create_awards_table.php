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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuing_organization')->nullable();
            $table->integer('year')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Path to award image/logo
            $table->integer('display_order')->default(0); // For sorting
            $table->boolean('is_active')->default(true);
            $table->string('category')->nullable(); // e.g., 'legal', 'corporate', 'client_service'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards');
    }
};
