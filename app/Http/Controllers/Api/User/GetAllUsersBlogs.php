<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetAllUsersBlogs extends Controller
{
    public function getAllUsersBlogs(Request $request)
    {
        $allBlogs = DB::table('blogs')->where('isApproved', true)->get();
        return response()->json($allBlogs);
    }
}
