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
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png',
                'isApproved' => true,
                'category_id' => 1, // Programming
                'user_id' => 2,
            ],
            [
                'title' => 'Laravel: Building Web Applications',
                'description' => 'Learn how to build web applications using the Laravel framework.',
                'image' => 'https://www.computerhope.com/jargon/j/javascript.png',
                'isApproved' => true,
                'category_id' => 2, // Laravel (child of Programming)
                'user_id' => 2,
            ],
            [
                'title' => 'Adventures in Travel',
                'description' => 'Embark on thrilling adventures and explore new places around the world.',
                'image' => 'https://miro.medium.com/v2/resize:fit:1358/1*moJeTvW97yShLB7URRj5Kg.png',
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
