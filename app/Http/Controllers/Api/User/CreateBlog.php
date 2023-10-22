<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Services\ImageService;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str; // Import the Str for Slug class
use App\Http\Requests\CreateBlogRequest; // Import the validation request

class CreateBlog extends Controller
{
    public function createBlog(CreateBlogRequest $request, ImageService $imageService)
    {
        // Received the Validated the request data

        // Retrieve the user ID from the authenticated user
        $user_id = $request->user()->id;

        // Create a new blog instance and fill it with request data
        $blog = new Blog($request->only(['title', 'description', 'category_id']));
        $blog->user_id = $user_id;


        // Check if an image was included in the request
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     // renaming procedure
        //     $originalName = $image->getClientOriginalName();
        //     $extension = $image->getClientOriginalExtension();
        //     // remove spaces from file name
        //     $imageName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_blogThumbnail_' . time() . '.' . $extension;
        //     $imagePath = $image->storeAs('blog_images', $imageName, 'public');
        //     $blog->image = $imagePath;
        // }

        // Check if an image was included in the request
        if ($request->hasFile('image')) {
            $imagePath = $imageService->upload($request->file('image'));
            if ($imagePath) {
                $blog->image = $imagePath;
            }
        }

        // Save the blog to the database
        $blog->save();

        // You can return a success response or the created blog data
        return response()->json(['message' => 'Blog created successfully', 'blog' => $blog], 201);
    }
}
