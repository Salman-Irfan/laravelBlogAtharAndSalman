<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $guestRole = Role::create(['name' => 'guest']);

        $createPosts = Permission::create(['name' => 'create posts']);
        $editPosts = Permission::create(['name' => 'edit own posts']);
        $deleteOwnPosts = Permission::create(['name' => 'delete own posts']);
        $viewPosts = Permission::create(['name' => 'view posts']);
        
        $createCategoryPermission = Permission::create(['name' => 'create category']);
        $updateCategoryPermission = Permission::create(['name' => 'update category']);
        $deleteCategoryPermission = Permission::create(['name' => 'delete category']);
        $getAllCategoriesPermission = Permission::create(['name' => 'get all categories']);
        $getAllUsersPermission = Permission::create(['name' => 'get all users']);
        $deleteUserPermission = Permission::create(['name' => 'delete user']);
        $approvePostPermission = Permission::create(['name' => 'approve post']);

        $adminRole->givePermissionTo([
            'create category',
    'update category',
    'delete category',
    'get all categories',
    'get all users',
    'delete user',
    'approve post',
    ]);
        $userRole->givePermissionTo(['register user',
        'login user',
        'get all post',
        'show comments',
        'logout user',
        'get user by id',
        'update user',
        'create post',
        'update post',
        'show posts for users',
        'delete post',
        'create comment',
    ]);

        $guestRole->givePermissionTo([
            'get all post',
            'show comments',
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin123@.com',
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('user');
    }
}