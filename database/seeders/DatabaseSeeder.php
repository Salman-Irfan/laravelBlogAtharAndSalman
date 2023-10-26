<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        
        // 
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        $admin->assignRole('admin');

        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);
        
        $user->assignRole('user');
        
        $guest = \App\Models\User::factory()->create([
            'id' => 0,
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'password'=> 'guest@123',
        ]);
        $user->assignRole('guest');
    }
}
