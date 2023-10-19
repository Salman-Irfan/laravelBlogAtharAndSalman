<?php

use App\Http\Controllers\Api\Admin\DeleteUserById;
use App\Http\Controllers\Api\Admin\GetAllBlogs;
use App\Http\Controllers\Api\Admin\GetAllUsers;
use App\Http\Controllers\Api\Admin\UpdateBlogStatus;
use App\Http\Controllers\Api\AuthControllers\{
    LoginController,
    RegisterController
};
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

    // ##### Protected Routes #####
    // login required
    Route::middleware(['auth:sanctum'])->group(function () {
        // Admin role required
        Route::middleware(['admin'])->group(function () {
            // users routes
            Route::get('/admin/get-all-users', [GetAllUsers::class, 'getAllUsers']);
            Route::delete('/admin/delete-user/{id}', [DeleteUserById::class, 'deleteUserById']);
            // blogs routes
            Route::get('/admin/all-blogs', [GetAllBlogs::class, 'getAllBlogs']); // under development
            Route::patch('/admin/update-blog-status/{id}', [UpdateBlogStatus::class, 'updateBlogStatus']); // under development
        });

        // User role required
        Route::middleware(['user'])->get('/user', function (Request $request) {
            return new LoginResource(auth()->user());
        });
    });
});

