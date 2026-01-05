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
        // Main page views table
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();
            $table->string('ip_address', 45)->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->string('device_type', 50)->nullable(); // mobile, desktop, tablet
            $table->string('browser', 100)->nullable();
            $table->string('platform', 100)->nullable(); // OS
            $table->string('url', 500);
            $table->string('page_title')->nullable();
            $table->string('referrer', 500)->nullable();
            $table->integer('time_on_page')->default(0); // seconds
            $table->timestamp('viewed_at');
            $table->timestamps();
            
            $table->index(['viewed_at', 'url']);
            // $table->index('session_id');
        });

        // Sessions table - aggregates visitor sessions
        Schema::create('visitor_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->string('ip_address', 45)->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->string('device_type', 50)->nullable();
            $table->string('browser', 100)->nullable();
            $table->string('platform', 100)->nullable();
            $table->string('landing_page', 500)->nullable();
            $table->string('exit_page', 500)->nullable();
            $table->integer('total_pages_viewed')->default(1);
            $table->integer('total_time_spent')->default(0); // seconds
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            
            $table->index('started_at');
            $table->index('ip_address');
        });

        // Click tracking table - track button/link clicks
        Schema::create('click_events', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();
            $table->string('url', 500); // page where click happened
            $table->string('element_type', 50); // button, link, etc
            $table->string('element_id')->nullable();
            $table->string('element_class')->nullable();
            $table->string('element_text')->nullable();
            $table->string('target_url', 500)->nullable();
            $table->timestamp('clicked_at');
            $table->timestamps();
        });

        // Popular content tracking
        Schema::create('popular_content', function (Blueprint $table) {
            $table->id();
            $table->string('content_type', 50); // expertise, lawyer, article
            $table->unsignedBigInteger('content_id');
            $table->string('content_title');
            $table->integer('view_count')->default(0);
            $table->date('date');
            $table->timestamps();
            
            $table->unique(['content_type', 'content_id', 'date']);
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popular_content');
        Schema::dropIfExists('click_events');
        Schema::dropIfExists('visitor_sessions');
        Schema::dropIfExists('page_views');
    }
};
