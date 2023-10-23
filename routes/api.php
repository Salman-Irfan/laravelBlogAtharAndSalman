<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;



// Public routes
Route::post('/register', [UserController::class, 'registerUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::get('/getAllPost', [PostController::class, 'getAllPost']);
Route::get('/showComments/{post_id}', [CommentController::class, 'showComments']);


// Admin Routes
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('/createCategory', [CategoryController::class, 'createCategory']);
    Route::put('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);
    Route::get('/getAllCategories', [CategoryController::class, 'getAllCategories']);
    Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
    Route::delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
    Route::patch('/approvePost/{id}', [PostController::class, 'updatePostStatus']);
    
});


// User Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logoutUser']);
    Route::get('/getUserById/{id}', [UserController::class, 'getUserById']);
    Route::patch('/updateUser/{id}', [UserController::class, 'updateUser']);
    Route::post('/createPost', [PostController::class, 'createPost']);
    Route::patch('/updatePost/{id}', [PostController::class, 'updatePost']);
    Route::get('/showPostsForUsers', [PostController::class, 'showPostsForUsers']);
    Route::delete('/deletePost/{id}', [PostController::class, 'deletePost']);
    Route::post('/createComment', [CommentController::class, 'createComment']);
});


// Guest Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/getAllPost', [PostController::class, 'getAllPost']);
});





// // Comments Routes
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::delete('/deleteComment/{comment_id}', [CommentController::class, 'deleteComment']);
//     Route::patch('/updateComment', [CommentController::class, 'updateComment']);
// });

// // Post Routes
// Route::middleware(['permission:create_post'])->post('/createpost', [PostController::class, 'create']);
