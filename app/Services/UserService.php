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
      // $user->assignRole('User');

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


    public function updateUser(User $user, array $userData)
    {
        $user->name = $userData['name'];

        if ($user->email !== $userData['email']) {
            $this->validateEmail($userData['email']);
            $user->email = $userData['email'];
        }
        if (isset($userData['password'])) {
            $user->password = Hash::make($userData['password']);
        }
        $user->save();
        return $user;
    }


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