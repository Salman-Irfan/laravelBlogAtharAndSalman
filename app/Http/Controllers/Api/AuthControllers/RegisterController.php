<?php

namespace App\Http\Controllers\Api\AuthControllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    // login function
    public function register(RegisterRequest $request)
    {

        // 1. validate request -> through RegisterRequest
        // 2. register user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        // 3. assign role to user
        // 1st get the specific role
        $user_role = Role::where(['name' => 'user'])->first();
        if ($user_role) {
            // assign role to user
            $user->assignRole($user_role);
        }
        // 3. sending response
        return new RegisterResource($user);
    }
}