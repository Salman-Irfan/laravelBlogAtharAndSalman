<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 

class PostController extends Controller
{
    // Create Post
    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        
        $user = Auth::user();
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }
        $post = Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);
        $user->posts()->save($post);
        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }
    

    // Update post 
    public function updatePost(Request $request, $id)
    {
        $post = Post::find($id);
        $imagePath=null;
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        
        $post = [
            'title' => 'required|max:255',
            'description' => 'required',
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $post);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        // Handle image upload (if needed)
        if ($request->hasFile('image')) 
        {
            $imagePath = $request->file('image')->store('uploads', 'public');
        } 
        else 
        {
            $imagePath = null;
        }
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
        return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
    }
  

    // Delete a post
    public function deletePost(Request $request, $id)
    {
       $post=Post::find($id);
        if ($post->user_id !== Auth::user()->id && !Auth::user()->hasRole('Admin')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

    // Show all posts
    public function getAllPost()
    {
        $posts = Post::all();
        return response()->json([
            'message' => 'Posts retrieved successfully',
            'data' => $posts,
        ]);
    }

    // show post for specific user
    public function showPostsForUsers()
    {
        $user=Auth::user(); 
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        $userPosts = Post::where('user_id', $user->id)->get();
        return response()->json(['post' => $userPosts], 200);

    }

}
