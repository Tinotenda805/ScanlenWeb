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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('focus_keyword')->nullable()->after('slug');
            $table->string('meta_description', 160)->nullable()->after('focus_keyword');
            $table->integer('seo_score')->default(0)->after('meta_description');
            $table->integer('readability_score')->default(0)->after('seo_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
};
