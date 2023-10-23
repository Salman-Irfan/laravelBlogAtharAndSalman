<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;


class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function createCategory(CategoryRequest $request)
    {
        $requestData = $request->validated();
        
        // Check if 'isChild' exists in the $requestData array before accessing it
        $isChild = $requestData['isChild'] ?? null;
    
        $category = $this->categoryService->createCategory($requestData, $isChild);
    
        return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
    }
    

    public function updateCategory(CategoryRequest $request, $id)
    {
        $requestData = $request->validated();
        $category = $this->categoryService->updateCategory($id, $requestData);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
    }

    public function deleteCategory($id)
    {
        $success = $this->categoryService->deleteCategory($id);
        if (!$success) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }

    public function getAllCategories()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json(['message' => 'Categories retrieved successfully', 'data' => $categories]);
    }

    public function getChildCategories($parentCategoryId)
    {
        $childCategories = $this->categoryService->getChildCategories($parentCategoryId);
        return response()->json(['message' => 'Child categories retrieved successfully', 'data' => $childCategories]);
    }
}















































// class CategoryController extends Controller
// {
    
//     // Create a new category
//     public function createCategory(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|max:255',
//             'isChild' => 'nullable|exists:categories,id',
//         ]);

//         $category = Category::create([
//             'name' => $request->input('name'),
//             'isChild' => $request->input('isChild'),
//         ]);

//         return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
//     }

//  // Update an existing category
// public function updateCategory(Request $request, $id)
// {
//     $category = Category::find($id);

//     if (!$category) {
//         return response()->json(['message' => 'Category not found'], 404);
//     }

//     $request->validate([
//         'name' => 'required|max:255',
//         'isChild' => [
//             'nullable',
//             'exists:categories,id',
//             function ($attribute, $value, $fail) use ($category) {
//                 if ($value == $category->id) {
//                     $fail('You cannot assign the parent ID to itself in isChild');
//                 }
//             },
//         ],
//     ]);

//     $category->name = $request->input('name');
//     $category->isChild = $request->input('isChild');
//     $category->save();

//     return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
// }


//     // Delete a category
//     public function deleteCategory(Request $request, $id)
//     {
//         $category = Category::find($id);

//         if (!$category) {
//             return response()->json(['message' => 'Category not found'], 404);
//         }

//         $category->delete();

//         return response()->json(['message' => 'Category deleted successfully'], 200);
//     }

//     // Retrieve all categories
//     public function getAllCategories()
//     {
//         $categories = Category::all();

//         return response()->json([
//             'message' => 'Categories retrieved successfully',
//             'data' => $categories,
//         ]);
//     }

//     // Retrieve child categories of a given parent category
//     public function getChildCategories($parentCategoryId)
//     {
//         $childCategories = Category::where('isChild', $parentCategoryId)->get();

//         return response()->json([
//             'message' => 'Child categories retrieved successfully',
//             'data' => $childCategories,
//         ]);
//     }

// }
