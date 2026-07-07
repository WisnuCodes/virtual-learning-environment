<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@lms.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $instructor = \App\Models\User::create([
            'name' => 'Instructor John',
            'email' => 'instructor@lms.com',
            'password' => bcrypt('password'),
            'role' => 'instructor',
        ]);

        $student = \App\Models\User::create([
            'name' => 'Student Jane',
            'email' => 'student@lms.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        $catWeb = \App\Models\Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
        ]);

        $catDesign = \App\Models\Category::create([
            'name' => 'UI/UX Design',
            'slug' => 'ui-ux-design',
        ]);

        $course1 = \App\Models\Course::create([
            'user_id' => $instructor->id,
            'category_id' => $catWeb->id,
            'title' => 'Complete Fullstack Web Developer Bootamp',
            'slug' => 'complete-fullstack-web-developer-bootcamp',
            'description' => 'Learn web development from scratch with HTML, CSS, JavaScript, PHP, and Laravel. Build real world applications.',
            'price' => 49.99,
            'thumbnail' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'status' => 'published',
        ]);

        $course2 = \App\Models\Course::create([
            'user_id' => $instructor->id,
            'category_id' => $catDesign->id,
            'title' => 'Mastering Figma for UI/UX Design',
            'slug' => 'mastering-figma',
            'description' => 'A complete guide to learning Figma. Design beautiful web and mobile applications with confidence.',
            'price' => 29.99,
            'thumbnail' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'status' => 'published',
        ]);

        // Course 1 Sections & Lessons
        $c1_section1 = \App\Models\Section::create([
            'course_id' => $course1->id,
            'title' => 'Getting Started with Web Development',
            'order_index' => 1,
        ]);

        \App\Models\Lesson::create([
            'section_id' => $c1_section1->id,
            'title' => 'Introduction to the Internet',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'In this lesson, we will understand how the internet works.',
            'is_free_preview' => true,
            'order_index' => 1,
        ]);

        \App\Models\Lesson::create([
            'section_id' => $c1_section1->id,
            'title' => 'Setting up the environment',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Let us install VS Code and a browser.',
            'is_free_preview' => true,
            'order_index' => 2,
        ]);

        $c1_section2 = \App\Models\Section::create([
            'course_id' => $course1->id,
            'title' => 'HTML5 Basics',
            'order_index' => 2,
        ]);

        \App\Models\Lesson::create([
            'section_id' => $c1_section2->id,
            'title' => 'Tags, Attributes, and Elements',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Let us learn the basics of HTML5 structure.',
            'is_free_preview' => false,
            'order_index' => 1,
        ]);

        // Course 2 Sections & Lessons
        $c2_section1 = \App\Models\Section::create([
            'course_id' => $course2->id,
            'title' => 'Figma Basics',
            'order_index' => 1,
        ]);

        \App\Models\Lesson::create([
            'section_id' => $c2_section1->id,
            'title' => 'Interface Walkthrough',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Getting to know the Figma interface and tools.',
            'is_free_preview' => true,
            'order_index' => 1,
        ]);
    }
}
