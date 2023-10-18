<?php

namespace App\Http\Controllers\Api\AuthControllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // login function
    public function login(LoginRequest $request)
    {   
        // 1. validate request -> through LoginRequest
        // 2. login user
        // attempt to login
        if (!Auth::attempt($request->only('email', 'password'))) {
            Helper::sendError('Email or password is incorrect', []);
        }
        return true;
        // 3. sending response
        
        return new UserResource(auth()->user());
    }
}
