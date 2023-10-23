<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class DeleteCommentController extends Controller
{
    public function deleteCommentController($id){
        // Find the comment by ID
        $comment = Comment::find($id);
        // Check if the comment exists
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        // Check if the authenticated user owns the comment
        $user = auth()->user();
        if ($comment->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        // Delete the comment
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully',
            'comment' => $comment
        ]);
    }
}
