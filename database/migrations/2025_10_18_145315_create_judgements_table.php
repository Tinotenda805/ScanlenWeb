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
        Schema::create('judgements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('case_number')->nullable();
            $table->text('description')->nullable();
            $table->date('judgement_date')->nullable();
            $table->string('court')->nullable(); // e.g., "Supreme Court", "High Court"
            $table->string('file_path'); // Path to PDF/DOC file
            $table->string('file_type')->nullable(); // pdf, doc, docx
            $table->bigInteger('file_size')->nullable(); // in bytes
            $table->unsignedInteger('download_count')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->json('tags')->nullable(); // Array of tags for filtering
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judgements');
    }
};
