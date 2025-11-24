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
        Schema::table('article_authors', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });
        
        Schema::table('article_tags', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });
        
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });
        
        Schema::table('awards', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('blog_comments', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('blog_tags', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });
        
        Schema::table('category_people', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('expertise', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('expertise_people', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('expertise_relations', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('gallery', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('history_timelines', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('judgements', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('our_people', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('statistics', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('uuid')->after('id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_authors', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        
        Schema::table('article_tags', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        
        Schema::table('awards', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('blog_comments', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('blog_tags', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        
        Schema::table('category_people', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('expertise', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('expertise_people', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('expertise_relations', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('gallery', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('history_timelines', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('judgements', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('our_people', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
