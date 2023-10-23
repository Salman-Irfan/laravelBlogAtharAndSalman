<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CreateCommentController extends Controller
{
    public function createCommentController (Request $request){
        // Validate the request data
        $this->validate($request, [
            'comment' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);
        // Create a new comment
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->blog_id = $request->input('blog_id');
        $comment->user_id = auth()->user()->id; // Assuming the comment is made by the authenticated user

        // Save the comment to the database
        $comment->save();

        // You can return a success response or the created comment data
        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment]);
    }
}
