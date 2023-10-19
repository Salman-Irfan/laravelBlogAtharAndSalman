<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class UpdateBlogStatus extends Controller
{
    public function updateBlogStatus(Request $request, $id) {
        $blog = Blog::find($id);
        // update the blog status
        $blog->isApproved = $request->isApproved;
        $blog->save();
        return response()->json([
            'message' => 'Blog status updated successfully',
            'data' => $blog
        ]);
    }
}
