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
        Schema::table('our_people', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('our_people', 'profile_overview')) {
                $table->longText('profile_overview')->nullable()->after('bio');
            }
            
            if (!Schema::hasColumn('our_people', 'years_of_experience')) {
                $table->integer('years_of_experience')->nullable()->after('profile_overview');
            }
            
            if (!Schema::hasColumn('our_people', 'deals_completed')) {
                $table->integer('deals_completed')->nullable()->after('years_of_experience');
            }
            
            if (!Schema::hasColumn('our_people', 'languages')) {
                $table->string('languages')->nullable()->after('deals_completed');
            }
            
            if (!Schema::hasColumn('our_people', 'linkedin_url')) {
                $table->string('linkedin_url')->nullable()->after('languages');
            }
            
            if (!Schema::hasColumn('our_people', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('linkedin_url');
            }
            
            if (!Schema::hasColumn('our_people', 'location')) {
                $table->string('location')->default('Harare, ZW')->after('whatsapp_number');
            }
            
            // JSON fields for complex data
            if (!Schema::hasColumn('our_people', 'areas_of_expertise')) {
                $table->json('areas_of_expertise')->nullable()->after('location')
                    ->comment('Array of expertise areas with descriptions');
            }
            
            if (!Schema::hasColumn('our_people', 'professional_experience')) {
                $table->json('professional_experience')->nullable()->after('areas_of_expertise')
                    ->comment('Array of work experience timeline');
            }
            
            if (!Schema::hasColumn('our_people', 'qualifications')) {
                $table->json('qualifications')->nullable()->after('professional_experience')
                    ->comment('Array of education and certifications');
            }
            
            if (!Schema::hasColumn('our_people', 'banner_image')) {
                $table->string('banner_image')->nullable()->after('avatar')
                    ->comment('Header/banner image for profile page');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('our_people', function (Blueprint $table) {
            $table->dropColumn([
                'profile_overview',
                'years_of_experience',
                'deals_completed',
                'languages',
                'linkedin_url',
                'whatsapp_number',
                'location',
                'areas_of_expertise',
                'professional_experience',
                'qualifications',
                'banner_image',
            ]);
        });
    }
};
