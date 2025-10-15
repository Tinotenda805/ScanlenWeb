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
        Schema::create('expertise', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('overview')->nullable();
            $table->string('image')->nullable(); // Main image for the expertise
            $table->string('banner_image')->nullable(); // Banner for detail page
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        // Pivot table for expertise relationships (related expertise)
        Schema::create('expertise_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expertise_id')->constrained('expertise')->onDelete('cascade');
            $table->foreignId('related_expertise_id')->constrained('expertise')->onDelete('cascade');
            $table->timestamps();
        });

        // Pivot table for people and their expertise (key contacts)
        Schema::create('expertise_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expertise_id')->constrained('expertise')->onDelete('cascade');
            $table->foreignId('person_id')->constrained('our_people')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            // Prevent duplicate assignments
            $table->unique(['expertise_id', 'person_id']);
        });

        // Add expertise columns to our_people table if not exists
        Schema::table('our_people', function (Blueprint $table) {
            if (!Schema::hasColumn('our_people', 'specializations')) {
                $table->text('specializations')->nullable()->after('bio');
            }
            if (!Schema::hasColumn('our_people', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('phone');
            }
        });

        // Update categories table to link with expertise (sectors)
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'type')) {
                $table->enum('type', ['general', 'sector', 'expertise'])->default('general')->after('slug');
            }
            if (!Schema::hasColumn('categories', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('image');
            }
            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('our_people', function (Blueprint $table) {
            $table->dropColumn('specializations');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['type', 'image']);
        });

        Schema::dropIfExists('expertise_people');
        Schema::dropIfExists('expertise_relations');
        Schema::dropIfExists('expertise');
    }
};
