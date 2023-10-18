<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetAllUsers extends Controller
{
    public function getAllUsers(Request $request){
        $users = DB::table("users")->select('id', 'name', 'email', 'email_verified_at', 'created_at', 'updated_at')->get();
        return $users;
    }
}
