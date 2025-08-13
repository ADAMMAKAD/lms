<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'quote' => 'SkillGro has transformed how our team approaches learning. The skill assessments helped us identify knowledge gaps and create targeted learning paths.',
                'customer_name' => 'Sarah Johnson',
                'customer_title' => 'Engineering Manager',
                'company' => 'TechCorp',
                'photo_url' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'quote' => 'The personalized learning experience is incredible. I went from beginner to advanced in React within 6 months.',
                'customer_name' => 'Michael Chen',
                'customer_title' => 'Frontend Developer',
                'company' => 'StartupXYZ',
                'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'quote' => 'SkillGro\'s certification program gave me the confidence to transition into a senior developer role. Highly recommended!',
                'customer_name' => 'Emily Rodriguez',
                'customer_title' => 'Senior Developer',
                'company' => 'InnovateLab',
                'photo_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}
