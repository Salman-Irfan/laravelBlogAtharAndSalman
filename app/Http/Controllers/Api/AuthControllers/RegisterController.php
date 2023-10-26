<?php

namespace App\Http\Controllers\Api\AuthControllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL; // for dynamically generated URLs
use Mail;
use Illuminate\Support\Str; // for random string generator

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
        // Email Verification Process
        $user = DB::table("users")->where("email", $user->email)->first();
        if ($user) {
            $random = Str::random(40); // random string of 40 characters
            $domain = URL::to('/'); // domain
            $url = $domain . '/verify-mail/' . $random;

            $data['url'] = $url;
            $data['email'] = $user->email;
            $data['title'] = 'Email Verification';
            $data['body'] = 'Click on the link below to verify your Email';
            // send verification link
            Mail::send(
                'verifyMailViewFile',
                [
                    'data' => $data
                ],
                function ($message) use ($data) {
                    $message
                        ->to($data['email'])
                        ->subject($data['title']);
                }
            );
            $user = User::find($user->id);
            $user->remember_token = $random;
            $user->save();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not Found'
            ]);
        }
        // 3. sending response
        return new RegisterResource($user);
    }
}