<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon; // for date time formatting


class VerifyEmailController extends Controller
{
    // public function verifyEmailController($email)
    // {
    //     $user = DB::table("users")->where("email", $email)->first();
    //     if ($user) {
    //         $random = Str::random(40); // random string of 40 characters
    //         $domain = URL::to('/'); // domain
    //         $url = $domain . '/verify-mail/' . $random;

    //         $data['url'] = $url;
    //         $data['email'] = $email;
    //         $data['title'] = 'Email Verification';
    //         $data['body'] = 'Click on the link below to verify your Email';
    //         // send verification link
    //         Mail::send(
    //             'verifyMailViewFile',
    //             [
    //                 'data' => $data
    //             ],
    //             function ($message) use ($data) {
    //                 $message
    //                     ->to($data['email'])
    //                     ->subject($data['title']);
    //             }
    //         );
    //         $user = User::find($user->id);
    //         $user->remember_token = $random;
    //         $user->save();
    //         // sending response
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Email sent successfully'
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'User not Found'
    //         ]);
    //     }

    // }

    // web.php
    public function verificationMail($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            // empty the rember_token
            $user->remember_token = "";
            // set the email verified at column
            $user->email_verified_at = Carbon::now();
            $user->save();
            // send the success response
            return response()->json([
                "success" => true,
                "message" => "Email is verified"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
    }
}
