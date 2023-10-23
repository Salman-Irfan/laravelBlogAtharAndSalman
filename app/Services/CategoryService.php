<?php
namespace App\Services;
use App\Http\Requests\CategoryRequest;

use App\Models\Category;

class CategoryService
{


    public function createCategory($requestData, $isChild)
{
    $categoryData = [
        'name' => $requestData['name'],
    ];
    // Only set 'isChild' if it's not null
    if ($isChild !== null) {
        $categoryData['isChild'] = $isChild;
    }
    $category = Category::create($categoryData);
    return $category;
}

// Update Category
public function updateCategory($id, $requestData)
{
    $category = Category::find($id);

    if (!$category) {
        return null;
    }

    $category->name = $requestData['name'];

    // Check if 'isChild' key exists in the request data and it's not equal to the category's ID
    if (isset($requestData['isChild']) && $requestData['isChild'] != $id) {
        $category->isChild = $requestData['isChild'];
    }else {
        return response()->json(['message' => 'You cannot assign the parent ID to itself in isChild'], 400);
    }

    $category->save();
    return $category;
}



    // Delete Category
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return false;
        }
        $category->delete();
        return true;
    }


    // Get All Category
    public function getAllCategories()
    {
        return Category::all();
    }

    // Retrive the isChilds
    public function getChildCategories($parentCategoryId)
    {
        return Category::where('isChild', $parentCategoryId)->get();
    }
}
