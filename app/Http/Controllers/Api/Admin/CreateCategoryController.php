<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CreateCategoryController extends Controller
{
    public function createCategoryController(Request $request){
        $categoryName = $request->input('name');
        $parentId = $request->input('isChild'); // can be null

        // Create a new category record using the query builder
        $category = Category::create([
            'name' => $categoryName,
            'isChild' => $parentId
        ]);
        
        return response()->json([
            'message' => 'Category added successfully', 
            'category' => $category]);
    }
}
