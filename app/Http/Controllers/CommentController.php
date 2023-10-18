<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{

    // Create Comment
    public function createComment(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|max:500',
            'post_id' => 'required',
        ]);
        $user = Auth::user();
        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => $user->id ?? 0,
            'post_id' => $request->input('post_id'),
        ]);
        $comment->save();
        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);
    }


    // Update Comment
    public function updateComment(Request $request, Comment $comment)
    {
        $user = Auth::user();
        if (!$user || $comment->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $validatedData = $request->validate([
            'comment' => 'required|max:500',
        ]);
        $comment->comment = $request->input('comment');
        $comment->save();
        return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment], 200);
    }


    // Delete Comment
    public function deleteComment(Request $request, Comment $comment)
    {
        $user = Auth::user();
        if (!$user || $comment->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}
