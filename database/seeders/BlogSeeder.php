<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'The World of Programming',
                'description' => 'Explore the exciting world of programming and coding.',
                'image' => 'programming.png',
                'isApproved' => true,
                'category_id' => 1, // Programming
                'user_id' => 2,
            ],
            [
                'title' => 'Laravel: Building Web Applications',
                'description' => 'Learn how to build web applications using the Laravel framework.',
                'image' => 'laravel.png',
                'isApproved' => true,
                'category_id' => 2, // Laravel (child of Programming)
                'user_id' => 2,
            ],
            [
                'title' => 'Adventures in Travel',
                'description' => 'Embark on thrilling adventures and explore new places around the world.',
                'image' => 'pakistan.png',
                'isApproved' => false,
                'category_id' => 3, // Travel
                'user_id' => 2,
            ],
        ];

        collect($blogs)->map(function ($blog) {
            Blog::create($blog);
        });
    }
}
