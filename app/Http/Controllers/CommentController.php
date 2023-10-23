<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\CommentService;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;



class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function createComment(CommentRequest $request)
    {
        $comment = $request->input('comment');
        $post_id = $request->input('post_id');
        $comment = $this->commentService->createComment($comment, $post_id);
        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);
    }
    
    
        public function showComments(Request $request, $post_id)
        {
            $post = Post::find($post_id);
            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }
            $comments = Comment::where('post_id', $post_id)->get();
            return response()->json(['comments' => $comments], 200);
        }
}








































































// public function deleteComment(Request $request, Comment $comment)
    //     {
    //         $user = Auth::user();
    //         if (!$user) {
    //             return response()->json(['message' => 'Unauthorized'], 401);
    //         }
    //         $comment->delete();
    //         return response()->json(['message' => 'Comment deleted successfully'], 200);
    //     }

// public function updateComment(CommentRequest $request, Comment $comment)
// {
//     $user = Auth::user();
//     if (!$user) {
//         return response()->json(['message' => 'Unauthorized'], 401);
//     }
//     $newComment = $request->input('comment');
//     $comment = $this->commentService->updateComment($comment, $newComment);
//     return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment], 200);
// }






// class CommentController extends Controller
// {

//     // Create Comment
//     public function createComment(Request $request)
//     {
//         $validatedData = $request->validate([
//             'comment' => 'required|max:500',
//             'post_id' => 'required',
//         ]);
//         $user = Auth::user();
//         $comment = Comment::create([
//             'comment' => $request->input('comment'),
//             'user_id' => $user->id ?? 0,
//             'post_id' => $request->input('post_id'),
//         ]);
//         $comment->save();
//         return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);
//     }


//     // Update Comment
//     public function updateComment(Request $request, Comment $comment)
//     {
//         $user = Auth::user();
//         if (!$user) {
//             return response()->json(['message' => 'Unauthorized'], 401);
//         }
//         $validatedData = $request->validate([
//             'comment' => 'required|max:500',
//         ]); 
//         $comment->comment = $request->input('comment');
//         $comment->save();
//         return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment], 200);
//     }


//     // Delete Comment
//     public function deleteComment(Request $request, Comment $comment)
//     {
//         $user = Auth::user();
//         if (!$user) {
//             return response()->json(['message' => 'Unauthorized'], 401);
//         }
//         $comment->delete();
//         return response()->json(['message' => 'Comment deleted successfully'], 200);
//     }


//     public function showComments(Request $request, $post_id)
//     {
//         $post = Post::find($post_id);

//         if (!$post) {
//             return response()->json(['message' => 'Post not found'], 404);
//         }
//         $comments = Comment::where('post_id', $post_id)->get();

//         return response()->json(['comments' => $comments], 200);
//     }
// }
