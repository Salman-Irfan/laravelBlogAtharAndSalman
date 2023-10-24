<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Services\ImageService;
use App\Models\Blog;
use Illuminate\Http\Request;

class UpdateBlogController extends Controller
{
    public function updateBlogController(UpdateBlogRequest $request,Blog $blog, ImageService $imageService){
        // Retrieve the user ID from the authenticated user, and validated data

        $user_id = $request->user()->id;

        if ($blog->user_id === $user_id) {
            // Initialize the data array for blog updates
            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'isApproved' => false,
            ];
            // Check if an image was included in the request
            if ($request->hasFile('image')) {
                $imagePath = $imageService->upload($request->file('image'));
                if ($imagePath) {
                    // If a new image is uploaded, update the image field
                    $data['image'] = $imagePath;
                }
            }
            // Update the blog
            $blog->update($data);
            return response()->json(['message' => 'Blog updated successfully', 'blog' => $blog]);
        } else {
            return response()->json(['message' => 'Unauthorized to update this blog'], 403);
        }
    }
}
