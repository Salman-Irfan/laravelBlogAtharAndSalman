<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function viewUserProfile(){
        $userId = auth()->user()->id; // Get the authenticated user's ID

        // Use the query builder to fetch user information and all details of their blogs
        $userData = DB::table('users')
            ->select('name', 'email')
            ->where('id', $userId)
            ->first(); // Retrieve the first matching user

        $userBlogs = DB::table('blogs')
            ->select('title', 'description', 'image', 'isApproved', 'category_id', 'created_at')
            ->where('user_id', $userId)
            ->get(); // Retrieve all blogs by the user

        // You can customize this data and return it as needed
        return response()->json(['user' => $userData, 'blogs' => $userBlogs]);
    }
}
