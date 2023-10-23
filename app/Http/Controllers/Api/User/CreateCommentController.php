<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;

class CreateCommentController extends Controller
{
    public function createCommentController(CreateCommentRequest $request)
    {
        // Retrieve the user from the authenticated user
        $user = $request->user();

        // Check if a user is authenticated and get the user ID
        $user_id = $user ? $user->id : null;

        // Create a new comment
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->blog_id = $request->input('blog_id');
        $comment->user_id = $user_id;

        // Save the comment to the database
        $comment->save();

        // Create an array for the response
        $response = ['message' => 'Comment created successfully', 'comment' => $comment];

        // If a user is authenticated, include the user_id in the response
        if ($user_id !== null) {
            $response['user_id'] = $user_id;
        }

        return response()->json($response);
    }

}
