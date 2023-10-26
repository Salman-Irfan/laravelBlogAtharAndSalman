<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRegistrationRequest;



class UserService
{
  public function registerUser(array $userData)
  {
      // Create a new user
      $user = User::create([
          'name' => $userData['name'],
          'email' => $userData['email'],
          'password' => Hash::make($userData['password']),
      ]);
   
      $user_role = Role::where(['name'=>'user'])->first();
        if($user_role){
            $user->assignRole($user_role);
        }
    //   $user->assignRole('user');

      return $user;
  }
    

    public function loginUser(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return [
                'message' => 'Login successfully',
                'user_id' => $user->id,
                'access_token' => $token,
            ];
        }
        return ['message' => 'Failed to login'];
    }

    // Update User
    public function updateUser(User $user, array $userData)
    {
        if (isset($userData['name'])) {
            $user->name = $userData['name'];
        }
        if (isset($userData['email'])) {
            if ($user->email !== $userData['email']) {
                $this->validateEmail($userData['email']);
                $user->email = $userData['email'];
            }
        }
        if (isset($userData['password'])) {
            $user->password = Hash::make($userData['password']);
        }
        
        // Save the user model to update the database
        $user->save();
        
        return $user; // Return the updated user
    }
    // public function updateUser(Request $request, $id)
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


    public function getUserById($id)
    {
        return User::find($id);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    public function getAllUsers()
    {
        return User::all();
    }

    private function validateEmail($email)
    {
        if (User::where('email', $email)->exists()) {
            throw new \Exception('Email address is already in use.');
        }
    }
}