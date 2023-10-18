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
        // 1. add permissions
        $canViewAllUsers = Permission::create(['name' => 'canViewAllUsers']); //admin
        $canDeleteUser = Permission::create(['name' => 'canDeleteUser']); //admin
        $canApproveBlog = Permission::create(['name' => 'canApproveBlog']); //admin
        $canCreateBlog = Permission::create(['name' => 'canCreateBlog']); //user
        $canUpdateBlog = Permission::create(['name' => 'canUpdateBlog']); //user
        $canDeleteBlog = Permission::create(['name' => 'canDeleteBlog']); //user
        // also publically available
        $canSeeAllBlogs = Permission::create(['name' => 'canSeeAllBlogs']); //user / guest
        $canCommentOnBlogs = Permission::create(['name' => 'canCommentOnBlogs']); //user / guest
        $canSeeAllComments = Permission::create(['name'=> 'canSeeAllComments']); //user / guest
        // 2. create role
        $admin_role = Role::create(['name' => 'admin']);
        // 3. assign permissions to role
        $admin_role->givePermissionTo([
            $canViewAllUsers,
            $canDeleteUser,
            $canApproveBlog
        ]);
        // 4. create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        // 5. assign role to admin user
        $admin->assignRole($admin_role);
        // ######### creating a normal user
        
        // 2. create normal user role
        $user_role = Role::create(['name' => 'user']);
        // 3. assign permissions to user role
        $user_role->givePermissionTo([
            $canCreateBlog,
            $canUpdateBlog,
            $canDeleteBlog,
            $canSeeAllBlogs,
            $canCommentOnBlogs,
            $canSeeAllComments
        ]);
        // 4. create normal user
        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
        // 5. assign role to normal user
        $user->assignRole($user_role);
        
    }
}
