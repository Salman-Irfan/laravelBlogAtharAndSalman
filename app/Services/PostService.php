<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class PostService
{
    public function createPost($data)
    {
        $user = Auth::user();
        $post = new Post([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'user_id' => $user->id,
        ]);

        if (isset($data['image'])) {
            $imagePath = $data['image']->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return $post;
    }

    public function updatePost($id, $data)
    {
        $post = Post::find($id);

        if (!$post) {
            return null;
        }

        $post->title = $data['title'];
        $post->description = $data['description'];

        if (isset($data['image'])) {
            $imagePath = $data['image']->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return $post;
    }

    public function updatePostStatus($id, $isApproved)
    {
        $post = Post::find($id);

        if (!$post) {
            return null;
        }

        $post->isApproved = $isApproved;
        $post->save();

        return $post;
    }

    public function deletePost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return false;
        }

        $post->delete();

        return true;
    }

    public function getAllPosts()
    {
        return Post::all();
    }

    public function getUserPosts()
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        return Post::where('user_id', $user->id)->get();
    }
}