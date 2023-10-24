<?php

use App\Http\Controllers\Api\Admin\DeleteUserById;
use App\Http\Controllers\Api\Admin\GetAllBlogs;
use App\Http\Controllers\Api\Admin\GetAllUsers;
use App\Http\Controllers\Api\Admin\UpdateBlogStatus;
use App\Http\Controllers\Api\AuthControllers\{
    LoginController,
    RegisterController
};
use App\Http\Controllers\Api\User\CreateBlog;
use App\Http\Controllers\Api\User\CreateCommentController;
use App\Http\Controllers\Api\User\DeleteCommentController;
use App\Http\Controllers\Api\User\GetAllUsersBlogs;
use App\Http\Controllers\Api\User\GetBlogByIdController;
use App\Http\Controllers\Api\User\UpdateBlogController;
use Illuminate\Support\Facades\Route;

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

// Group routes with the prefix 'v1'
Route::prefix('v1')->group(function () {
    // ###### Public Routes #####
    // register route
    Route::post('/register', [RegisterController::class, 'register']);
    // login route
    Route::post('/login', [LoginController::class, 'login']);

    // public routes
    Route::prefix('public')->group(function () {
        // Blogs routes
        Route::get('/all-users-blogs', [GetAllUsersBlogs::class, 'getAllUsersBlogs']);
        // get blog by id - public
        Route::get('/get-blog/{id}', [GetBlogByIdController::class, 'getBlogByIdController']);
    });

    // ##### Protected Routes #####
    // login required
    Route::middleware(['auth:sanctum'])->group(function () {
        // Admin role required
        Route::middleware(['admin'])->group(function () {
            // prefix for admin
            Route::prefix('admin')->group(function () {
                // Users routes
                Route::get('/get-all-users', [GetAllUsers::class, 'getAllUsers']);
                Route::delete('/delete-user/{id}', [DeleteUserById::class, 'deleteUserById']);
                // Blogs routes
                Route::get('/all-blogs', [GetAllBlogs::class, 'getAllBlogs']);
                Route::patch('/update-blog-status/{id}', [UpdateBlogStatus::class, 'updateBlogStatus']);
            });
        });

        // User role required
        Route::middleware(['user'])->group(function () {
            // prefix for admin
            Route::prefix('user')->group(function () {
                Route::post('/create-blog', [CreateBlog::class, 'createBlog']);
                Route::post('/create-comment', [CreateCommentController::class, 'createCommentController']);
                Route::delete('/delete-comment/{id}', [DeleteCommentController::class, 'deleteCommentController']);
                Route::put('/update-blog/{blog}', [UpdateBlogController::class, 'updateBlogController']);
            });
        });
    });
});

