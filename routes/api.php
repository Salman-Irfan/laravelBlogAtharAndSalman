<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Public routes
Route::post('/register', [UserController::class, 'registerUser']);
Route::post('/login', [UserController::class, 'loginUser']);

// User Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logoutUser']);
    Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);
    Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
    Route::patch('/updateUser', [UserController::class, 'updateUser']);
    Route::get('/getUserById/{id}', [UserController::class, 'getUserById']);
});

// Post Routes
Route::post('/createPost', [PostController::class, 'createPost']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::patch('/updatePost', [PostController::class, 'updatePost']);
    Route::delete('/deletePost/{id}', [PostController::class, 'deletePost']);
    Route::get('/getAllPost', [PostController::class, 'getAllPost']);
    Route::get('/showPostsForUser', [PostController::class, 'showPostsForUser']);

});

// Comments Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/createComment', [CommentController::class, 'createComment']);
    Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment']);
    Route::get('/showAllComments', [CommentController::class, 'showAllComments']);
});


// Guest Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/posts', [PostController::class, 'index']);

    // Route::post('/create/comment', [CommentController::class, 'createComment']);
// Route::get('/posts/{post_id}/comments', [CommentController::class, 'showComments']);
});






// // Post Routes
// Route::middleware(['permission:create_post'])->post('/createpost', [PostController::class, 'create']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
