<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class GetCategoriesController extends Controller
{
    public function getAllCategories(){
        $categories = Category::select('id', 'name', 'isChild')->get();
        return response()->json(['categories' => $categories]);
    }
}
