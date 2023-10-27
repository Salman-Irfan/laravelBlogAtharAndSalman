<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GetAllBlogs extends Controller
{
    public function getAllBlogs(Request $request)
    {
        $allBlogs = DB::table("blogs")
            ->join('categories', 'blogs.category_id', '=', 'categories.id')
            ->select(
                'blogs.id as id',
                'blogs.title as title',
                'blogs.description as description',
                'blogs.image as image',
                'blogs.isApproved as isApproved',
                'categories.name as category_name', // Include the category name
                'blogs.user_id as user_id',
                'blogs.created_at as created_at',
                'blogs.updated_at as updated_at'
            )
            ->get();

        // Convert image file paths to URLs
        $allBlogs->transform(function ($blog) {
            $blog->image = Storage::url($blog->image);

            // Add "blogStatus" field based on "isApproved" value
            $blog->blogStatus = $blog->isApproved ? 'Approved' : 'Pending';

            return $blog;
        });

        return $allBlogs;
    }
}
