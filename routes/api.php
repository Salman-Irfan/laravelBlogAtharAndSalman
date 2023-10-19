<?php

use App\Http\Controllers\Api\Admin\DeleteUserById;
use App\Http\Controllers\Api\Admin\GetAllBlogs;
use App\Http\Controllers\Api\Admin\GetAllUsers;
use App\Http\Controllers\Api\Admin\UpdateBlogStatus;
use App\Http\Controllers\Api\AuthControllers\{
    LoginController,
    RegisterController
};
use App\Http\Controllers\Api\User\GetAllUsersBlogs;
use App\Http\Resources\Auth\LoginResource;
use Illuminate\Http\Request;
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

    // Blogs routes
    Route::get('/all-users-blogs', [GetAllUsersBlogs::class, 'getAllUsersBlogs']);
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
                
            });
        });
    });
});

