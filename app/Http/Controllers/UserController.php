<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;

class UserController extends Controller{
    
public function __construct(UserService $userService)
{
    $this->userService = $userService;
}

// Resiter User
public function registerUser(UserRegistrationRequest $request)
{
    $userData = $request->validated(); 
    $user = $this->userService->registerUser($userData);
    return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
}

// Login User
public function loginUser(UserLoginRequest $request)
{
    $credentials = $request->validated();
    $response = $this->userService->loginUser($credentials);
    return response()->json($response);
}


// Update User
public function updateUser(UserUpdateRequest $request, $id)
{
    $user = $this->userService->getUserById($id);
    if (!$user) {   
        return response()->json(['message' => 'User not found'], 404);
    }

    $userData = $request->validated();
    $updatedUser = $this->userService->updateUser($user, $userData);

    return response()->json(['message' => 'User updated successfully', 'user' => $updatedUser], 200);
}


// Get By Id
public function getUserById($id)
{
    $user = $this->userService->getUserById($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    return response()->json(['user' => $user], 200);
}


// Delete User
public function deleteUser($id)
{
    $user = $this->userService->getUserById($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    $this->userService->deleteUser($user);
    return response()->json(['message' => 'User deleted successfully'], 200);
}

// Get all  user 
public function getAllUsers()
{
    $users = $this->userService->getAllUsers();
    return response()->json(['users' => $users], 200);
}
// Logout
   public function logoutUser(Request $request) {
       if ($request->user()) { 
           $request->user()->tokens()->delete();
       }
       return response()->json(['message' => 'Logout successfully'], 200);
   }

}

















// class UserController extends Controller
// {
    
     
    
//     public function loginUser(Request $request) {
//         $credentials = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|string',
//         ]);
    
//         if (Auth::attempt($credentials)) {
//             $user = Auth::user();
//             $token = $user->createToken('authToken')->plainTextToken;
    
//             return response()->json([
//                 'message' => 'Login successfully',
//                 'user_id' => $user->id,
//                 'access_token' => $token,
//             ]);
//         }
    
//         return response()->json(['message' => 'Failed to login'], 401);
//     }


//     // Logout
//     public function logoutUser(Request $request) {
//         if ($request->user()) { 
//             $request->user()->tokens()->delete();
//         }
//         return response()->json(['message' => 'Logout successfully'], 200);
//     }


//     // Update the user    
//     public function updateUser(Request $request, $id)
//     {
//         $user = User::find($id);
//         if (!$user) {
//             return response()->json(['message' => 'User not found'], 404);
//         }
//         $validatedData = $request->validate([
//             'name' => 'string',
//             'email' => 'email|unique:users',
//             'password' => 'string|min:6',
//         ]);
//         $user->fill($validatedData);
//         if ($request->has('password')) {
//             $user->password = Hash::make($request->input('password'));
//         }
//         $user->save();
//         return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
//     }
    

//     // Get User by id
//     public function getUserById($id)
//     {
//         $user = User::find($id);
//         if (!$user) {
//             return response()->json(['message' => 'User not found'], 404);
//         }
//         return response()->json(['user' => $user], 200);
//     }


//     // Delete user by ID
//     public function deleteUser($id)
//     {
//         $user = User::find($id);
//         if (!$user) {
//             return response()->json(['message' => 'User not found'], 404);
//         }
//         $user->delete();
//         return response()->json(['message' => 'User deleted successfully'], 200);
//     }

//     // Get all users
//     public function getAllUsers()
//     {
//         $users = User::all();
//         return response()->json(['users' => $users], 200);
//     }
// }
