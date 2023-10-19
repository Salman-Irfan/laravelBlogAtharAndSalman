<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteUserById extends Controller
{
    public function deleteUserById(Request $request, $id)
    {
        try {
            // Get the user details before deletion
            $user = DB::table('users')->where('id', $id)->first();

            if ($user) {
                // Delete the user with the given ID using the query builder
                $deletedUser = DB::table('users')->where('id', $id)->delete();

                // Unset the 'password' field from the user object
                unset($user->password);

                if ($deletedUser) {
                    return response()->json(['message' => 'User deleted successfully', 'user' => $user], 200);
                } else {
                    return response()->json(['message' => 'User not found or could not be deleted'], 404);
                }
            } else {
                return response()->json(['message' => 'User not found or could not be deleted'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the user'], 500);
        }
    }

}
