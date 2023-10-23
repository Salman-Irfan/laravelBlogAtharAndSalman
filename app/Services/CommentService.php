<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function createComment($comment, $post_id)
    {
        $user = Auth::user();
        $comment = Comment::create([
            'comment' => $comment,
            'user_id' => $user->id ?? 0,
            'post_id' => $post_id,
        ]);
        return $comment;
    }

    // public function updateComment(Comment $comment, $newComment)
    // {
    //     $comment->comment = $newComment;
    //     $comment->save();
    //     return $comment;
    // }

    // public function deleteComment(Comment $comment)
    // {
    //     $comment->delete();
    // }
}
