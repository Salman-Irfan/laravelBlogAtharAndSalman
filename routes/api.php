<?php

use App\Http\Controllers\Api\AuthControllers\LoginController;
use App\Http\Controllers\Api\AuthControllers\RegisterController;
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

// ###### Public Routes #####
// register route
Route::post('/v1/register', [RegisterController::class, 'register']);
// login route
Route::post('/v1/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// login required
// admin routes
Route::middleware(['auth:sanctum', 'admin'])->get('/v1/admin', function (Request $request) {
    return new LoginResource(auth()->user());
});
// user routes
