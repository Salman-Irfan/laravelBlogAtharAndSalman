<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            [
                'comment' => 'Great article! I really enjoyed reading about programming.',
                'blog_id' => 1,
                // Link to the blog with ID 1 (Programming)
                'user_id' => 2,
                // Use the appropriate user_id
            ],
            [
                'comment' => 'Laravel is such a powerful framework. Thanks for the informative post!',
                'blog_id' => 2,
                // Link to the blog with ID 2 (Laravel)
                'user_id' => 2,
                // Use the appropriate user_id
            ],
            [
                'comment' => 'I love traveling, and this blog post is inspiring!',
                'blog_id' => 3,
                // Link to the blog with ID 3 (Travel)
                'user_id' => 2,
                // Use the appropriate user_id
            ],
        ];

        // Insert the data into the 'comments' table
        collect($comments)->map(function ($comment) {
            Comment::create($comment);
        });
    }
}
