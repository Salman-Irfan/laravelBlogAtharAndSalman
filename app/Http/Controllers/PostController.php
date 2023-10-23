<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\PostRequest;
use App\Services\PostService;


class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function createPost(PostRequest $request)
    {
        $data = $request->all();
        $post = $this->postService->createPost($data);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    public function updatePost(PostRequest $request, $id)
    {
        $data = $request->all();
        $post = $this->postService->updatePost($id, $data);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
    }

    public function updatePostStatus(Request $request, $id)
    {
        $isApproved = $request->input('isApproved');
        $post = $this->postService->updatePostStatus($id, $isApproved);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json(['message' => 'Blog status updated successfully', 'data' => $post]);
    }

    public function deletePost(Request $request, $id)
    {
        $success = $this->postService->deletePost($id);

        if (!$success) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

    public function getAllPost()
    {
        $posts = $this->postService->getAllPosts();

        return response()->json([
            'message' => 'Posts retrieved successfully',
            'data' => $posts,
        ]);
    }

    public function showPostsForUsers()
    {
        $userPosts = $this->postService->getUserPosts();

        if (!$userPosts) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        return response()->json(['post' => $userPosts], 200);
    }
}










































// class PostController extends Controller
// {
//     // Create Post
//     public function createPost(Request $request)
//     {
//         $user=Auth::user();
//         // Validation rules
//         $rules = [
//             'title' => 'required|max:255',
//             'description' => 'required',
//             'category_id' => 'required|exists:categories,id',
//         ];

//         // Validate the request
//         $validator = Validator::make($request->all(), $rules);

//         if ($validator->fails()) {
//             return response()->json(['errors' => $validator->errors()], 400);
//         }

//         // Handle image upload (if needed)
//         if ($request->hasFile('image')) 
//         {
//             $imagePath = $request->file('image')->store('uploads', 'public');
//         } 
//         else 
//         {
//             $imagePath = null;
//         }

//         // Create a new post
//         $post = Post::create([
//             'title' => $request->input('title'),
//             'description' => $request->input('description'),
//             'image' => $imagePath,
//             'category_id' => $request->input('category_id'),
//             'user_id' => $user->id,
//         ]);

//         // Return a JSON response indicating success
//         return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
//     }
    

//   // Update post 
// public function updatePost(Request $request, $id)
// {
//     $post = Post::find($id);
//     $imagePath = null;
//     if (!$post) {
//         return response()->json(['message' => 'Post not found'], 404);
//     }

//     // Define the validation rules as an associative array
//     $rules = [
//         'title' => 'required|max:255',
//         'description' => 'required',
//     ];

//     // Validate the request
//     $validator = Validator::make($request->all(), $rules);

//     if ($validator->fails()) {
//         return response()->json(['errors' => $validator->errors()], 400);
//     }

//     // Handle image upload (if needed)
//     if ($request->hasFile('image')) {
//         $imagePath = $request->file('image')->store('uploads', 'public');
//     }

//     // Update the post attributes
//     $post->title = $request->input('title');
//     $post->description = $request->input('description');
//     if (!is_null($imagePath)) {
//         $post->image_path = $imagePath; // Assuming your Post model has an 'image_path' attribute
//     }
//     $post->save();

//     return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
// }



// public function updatePostStatus(Request $request, $id) {
//     $post = Post::find($id);
//     // update the blog status
//     $post->isApproved = $request->isApproved;
//     $post->save();
//     return response()->json([
//         'message' => 'Blog status updated successfully',
//         'data' => $post
//     ]);
// }
  

//     // Delete a post
//     public function deletePost(Request $request, $id)
//     {
//        $post=Post::find($id);
//         if ($post->user_id !== Auth::user()->id && !Auth::user()->hasRole('Admin')) {
//             return response()->json(['message' => 'Unauthorized'], 401);
//         }
//         $post->delete();
//         return response()->json(['message' => 'Post deleted successfully'], 200);
//     }

//     // Show all posts
//     public function getAllPost()
//     {
//         $posts = Post::all();
//         return response()->json([
//             'message' => 'Posts retrieved successfully',
//             'data' => $posts,
//         ]);
//     }

//     // show post for specific user
//     public function showPostsForUsers()
//     {
//         $user=Auth::user(); 
//         if (!$user) {
//             return response()->json(['message' => 'User not authenticated'], 401);
//         }
//         $userPosts = Post::where('user_id', $user->id)->get();
//         return response()->json(['post' => $userPosts], 200);

//     }

// }
