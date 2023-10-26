<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class GetAllBlogs extends Controller
{
    public function getAllBlogs (Request $request){
        $allBlogs = DB::table("blogs")->get();
        // Convert image file paths to URLs
        $allBlogs->transform(function ($blog) {
            $blog->image = Storage::url($blog->image);
            return $blog;
        });
        return $allBlogs;
    }
}
