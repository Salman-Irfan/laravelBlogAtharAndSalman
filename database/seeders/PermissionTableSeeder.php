<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $guestRole = Role::create(['name' => 'guest']);

        $createPosts = Permission::create(['name' => 'create posts']);
        $updatePosts = Permission::create(['name' => 'update post']);
        $deletePosts = Permission::create(['name' => 'delete post']);
        $showPosts = Permission::create(['name' => 'show posts for users']);

        $createCategory = Permission::create(['name' => 'create category']);
        $updateCategory = Permission::create(['name' => 'update category']);
        $deleteCategory = Permission::create(['name' => 'delete category']);
        $getAllCategories = Permission::create(['name' => 'get all category']);

        $getAllUsers = Permission::create(['name' => 'get all users']);
        $updateUser = Permission::create(['name' => 'update user']);
        $deleteUser = Permission::create(['name' => 'delete user']);
        $approvePost = Permission::create(['name' => 'approve post']);
        $createComment = Permission::create(['name' => 'create comment']);
        $showComment = Permission::create(['name' => 'show comments']);
        $logout = Permission::create(['name' => 'logout user']);
        $getUserById = Permission::create(['name' => 'get user by id']);
       

        $adminRole->givePermissionTo([
            'create category',
            'update category',
            'delete category',
            'get all category',
            'get all users',
            'delete user',
            'approve post',
            'get user by id',
            'logout user',
            // 'get all post'

    ]);

    $userRole->givePermissionTo([
        'show comments',
        'logout user',
        'update user',
        'create posts',
        'update post',
        'show posts for users',
        'delete post',
        'create comment',
        'get user by id',

    ]);

        $guestRole->givePermissionTo([
            'get all post', 
        ]);

    }
}