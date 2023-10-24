<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; // for date time formatting
use Illuminate\Support\Facades\URL; // for dynamically generated URLs
use Mail;
use Illuminate\Support\Str; // for random string generator

class VerifyEmailController extends Controller
{
    public function verifyEmailController($email)
    {
        if (auth()->user()) {
            $user = User::where("email", $email)->first();
            if ($user) {
                $data['email'] = $email;
                $data['title'] = 'Email Verification';
                $data['body'] = 'Click on the link below to verify your Email';

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
