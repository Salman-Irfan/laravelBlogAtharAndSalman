<?php

use App\Http\Controllers\Api\Admin\GetAllUsers;
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
        // Admin routes
        Route::middleware(['admin'])->group(function () {
            Route::get('/admin/get-all-users', [GetAllUsers::class, 'getAllUsers']);
            Route::get('/admin/delete-user/{id}', [GetAllUsers::class, 'getAllUsers']); // under development
        });

        // User routes
        Route::middleware(['user'])->get('/user', function (Request $request) {
            return new LoginResource(auth()->user());
        });
    });
});

