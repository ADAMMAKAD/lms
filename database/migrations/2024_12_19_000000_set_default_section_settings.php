<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert default section settings if they don't exist
        $defaultSettings = [
            'hero_section' => 1,
            'our_features_section' => 1,
            'featured_course_section' => 1,
            'about_section' => 1,
            'top_category_section' => 1,
            'testimonial_section' => 1,
            'brands_section' => 1,
            'latest_blog_section' => 1,
            'news_letter_section' => 1,
            'featured_instructor_section' => 1,
            'counter_section' => 1,
            'faq_section' => 1,
            'banner_section' => 1,
        ];

        // Check if section_settings table exists and has data
        if (Schema::hasTable('section_settings')) {
            $existingSettings = DB::table('section_settings')->first();
            
            if (!$existingSettings) {
                // Insert default settings
                DB::table('section_settings')->insert(array_merge($defaultSettings, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is irreversible as it's for cleanup
    }
};