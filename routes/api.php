<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;



// Public routes
Route::post('/register', [UserController::class, 'registerUser']);
Route::get('/getAllPost', [PostController::class, 'getAllPost']);
Route::post('/login', [UserController::class, 'loginUser']);


// Admin Routes
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::middleware(['permission:create category'])->post('/createCategory', [CategoryController::class, 'createCategory']);
    Route::middleware(['permission:update category'])->put('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
    Route::middleware(['permission:get all category'])->get('/getAllCategories', [CategoryController::class, 'getAllCategories']);
    Route::middleware(['permission:delete user'])->delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);
    Route::middleware(['permission:get all users'])->get('/getAllUsers', [UserController::class, 'getAllUsers']);
    Route::middleware(['permission:delete category'])->delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
    Route::middleware(['permission:approve post'])->patch('/approvePost/{id}', [PostController::class, 'updatePostStatus']);
    Route::middleware(['permission:get user by id'])->get('/getUserById/{id}', [UserController::class, 'getUserById']);
});


// User Routes
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::middleware(['permission:logout user'])->post('/logout', [UserController::class, 'logoutUser']);
    Route::middleware(['permission:update user'])->patch('/updateUser/{id}', [UserController::class, 'updateUser']);
    Route::middleware(['permission:create posts'])->post('/createPost', [PostController::class, 'createPost']);
    Route::middleware(['permission:update post'])->patch('/updatePost/{id}', [PostController::class, 'updatePost']);
    Route::middleware(['permission:show posts for users'])->get('/showPostsForUsers', [PostController::class, 'showPostsForUsers']);
    Route::middleware(['permission:delete post'])->delete('/deletePost/{id}', [PostController::class, 'deletePost']);
    Route::middleware(['permission:create comment'])->post('/createComment', [CommentController::class, 'createComment']);
    Route::middleware(['permission:show comments'])->get('/showComments/{post_id}', [CommentController::class, 'showComments']);
});

Route::middleware(['guest'])->group(function () {
    Route::middleware(['permission:get all post'])->get('/getAllPost', [PostController::class, 'getAllPost']);
});



    

// // Comments Routes
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::delete('/deleteComment/{comment_id}', [CommentController::class, 'deleteComment']);
//     Route::patch('/updateComment', [CommentController::class, 'updateComment']);
// });

// // Post Routes
// Route::middleware(['permission:create_post'])->post('/createpost', [PostController::class, 'create']);
