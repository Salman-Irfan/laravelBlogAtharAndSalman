<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class GetAllBlogs extends Controller
{
    public function getAllBlogs (Request $request){
        $allBlogs = DB::table("blogs")->get();
        return $allBlogs;
    }
}
