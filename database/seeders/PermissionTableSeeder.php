<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    
    public function run(): void
    {
        $canViewAllUsers = Permission::create(['name' => 'canViewAllUsers']); 
        $canDeleteUser = Permission::create(['name' => 'canDeleteUser']); 
        $canUpdateBlog = Permission::create(['name' => 'canUpdateBlog']); 
        $canDeleteBlog = Permission::create(['name' => 'canDeleteBlog']); 
        $canSeeAllPosts = Permission::create(['name' => 'canSeeAllBlogs']); 
        $canCommentOnPosts = Permission::create(['name' => 'canCommentOnBlogs']); 
        
        $admin_role = Role::create(['name' => 'admin']);
       
        $admin_role->givePermissionTo([
            $canViewAllUsers,
            $canDeleteUser,
        ]);
        
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);
      
        $admin->assignRole($admin_role);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
     
        $user_role = Role::create(['name' => 'user']);
        $user_role->givePermissionTo([
            $canCreateBlog,
            $canUpdateBlog,
            $canDeleteBlog,
            $canSeeAllBlogs,
            $canCommentOnBlogs,
        ]);
        $user->assignRole($user_role);  
    }
}
