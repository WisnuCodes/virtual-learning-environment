<?php

namespace Database\Seeders;

use App\Models\ForumCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'General Discussion',
                'description' => 'Diskusikan apa saja mengenai pembelajaran dan teknologi secara umum.',
                'icon' => 'fa-comments'
            ],
            [
                'name' => 'Tech & Programming',
                'description' => 'Diskusi mendalam mengenai coding, framework, dan pengembangan software.',
                'icon' => 'fa-code'
            ],
            [
                'name' => 'Design & Creative',
                'description' => 'Bagikan karya Anda dan diskusikan tren UI/UX serta desain grafis.',
                'icon' => 'fa-palette'
            ],
            [
                'name' => 'Business & Marketing',
                'description' => 'Diskusi seputar strategi bisnis, startup, dan pemasaran digital.',
                'icon' => 'fa-chart-line'
            ],
            [
                'name' => 'Career Advice',
                'description' => 'Tips mencari kerja, interview, dan pengembangan karir profesional.',
                'icon' => 'fa-briefcase'
            ],
            [
                'name' => 'Q&A Support',
                'description' => 'Tanyakan kesulitan teknis Anda dan dapatkan bantuan dari komunitas.',
                'icon' => 'fa-circle-question'
            ]
        ];

        foreach ($categories as $category) {
            ForumCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon']
            ]);
        }
    }
}
