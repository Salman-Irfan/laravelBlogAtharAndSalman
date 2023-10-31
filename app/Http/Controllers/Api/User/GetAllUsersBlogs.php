<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GetAllUsersBlogs extends Controller
{
    public function getAllUsersBlogs(Request $request)
    {
        $baseURL = 'http://10.0.10.187:8000';
        $allBlogs = DB::table('blogs')->where('isApproved', true)->get();

        // // Convert images to base64
        // foreach ($allBlogs as $blog) {
        //     if ($blog->image) {
        //         // convert image into base 64
        //         $imagePath = Storage::disk('public')->path($blog->image);
        //         //  reads the binary image data 
        //         $imageData = file_get_contents($imagePath);
        //         //  generates a Base64-encoded data
        //         $base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
        //         // resulting Base64-encoded image
        //         $blog->image = $base64Image;
        //     }
        // }
        // Convert image file paths to URLs
        $allBlogs->transform(function ($blog) {
            $baseURL = 'http://10.0.10.187:8000';
            $blog->image = $baseURL . Storage::url($blog->image);
            return $blog;
        });


        return response()->json($allBlogs);
    }
}
