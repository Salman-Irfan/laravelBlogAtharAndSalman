<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class GetBlogByIdController extends Controller
{
    public function getBlogByIdController($id)
    {

        $blog = DB::table('blogs')
            ->select(
                'blogs.id as blog_id',
                'blogs.title as blog_title',
                'blogs.image as blog_image',
                'blogs.description as blog_description',
                'blogs.category_id as blog_category_id',
                'categories.name as blog_category_name',
                'blogs.created_at as blog_timestamps',
                'users.name as user_name'
            )
            ->join('categories', 'blogs.category_id', '=', 'categories.id')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->where('blogs.id', $id)
            ->first();

        // Convert image file path to URL
        if ($blog->blog_image) {
            $baseURL = 'http://10.0.10.187:8000';
            $blog->blog_image = $baseURL . Storage::url($blog->blog_image);
        }

        if ($blog) {
            $blog->comments = DB::table('comments')
                ->select(
                    'comments.id as comment_id',
                    'comments.comment as comment',
                    'users.id as user_id',
                    'users.name as user_name',
                    'comments.created_at as comment_timestamps'
                )
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->where('comments.blog_id', $blog->blog_id)
                ->get();
        }

        return response()->json(['blog' => $blog]);


    }
}
