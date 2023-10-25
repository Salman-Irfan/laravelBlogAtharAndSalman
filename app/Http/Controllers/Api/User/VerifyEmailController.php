<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; // for date time formatting
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL; // for dynamically generated URLs
use Mail;
use Illuminate\Support\Str; // for random string generator

class VerifyEmailController extends Controller
{
    public function verifyEmailController($email)
    {
        if (auth()->user()) {
            $user = DB::table("users")->where("email", $email)->first();
            if ($user) {
                $random = Str::random(40); // random string of 40 characters
                $domain = URL::to('/'); // domain
                $url = $domain .'/verify-mail/'. $random;

                $data['url'] = $url;
                $data['email'] = $email;
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
                // sending response
                return response()->json([
                    'success'=>true,
                    'message'=> 'Email sent successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not Found'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User is not Authenticated'
            ]);
        }
    }
}
