<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
class GetBlogByIdController extends Controller
{
    public function getBlogByIdController($id){

$blog = DB::table('blogs')
    ->select('blogs.id as blog_id', 'blogs.title as blog_title', 'blogs.image as image', 'blogs.description as blog_description', 'blogs.category_id as blog_category_id', 'categories.name as blog_category_name', 'blogs.created_at as blog_timestamps')
    ->join('categories', 'blogs.category_id', '=', 'categories.id')
    ->where('blogs.id', $id)
    ->first();

        if ($blog->image) {
            // convert image into base 64
            $imagePath = Storage::disk('public')->path($blog->image);
            //  reads the binary image data 
            $imageData = file_get_contents($imagePath);
            //  generates a Base64-encoded data
            $base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
            // resulting Base64-encoded image
            $blog->image = $base64Image;
        }

if ($blog) {
    $blog->comments = DB::table('comments')
        ->select('comments.id as comment_id', 'comments.comment as comment', 'users.id as user_id', 'users.name as user_name', 'comments.created_at as comment_timestamps')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.blog_id', $blog->blog_id)
        ->get();
}

return response()->json(['blog' => $blog]);

    }
}
