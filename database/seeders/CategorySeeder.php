<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'programming',
                'isChild' => null,
            ],
            [
                'name' => 'laravel',
                'isChild' => 1,
            ],
            [
                'name' => 'travel',
                'isChild' => null,
            ],
        ];

        // Use the map method to create Category model instances and save them
        collect($categories)->map(function ($category) {
            Category::create($category);
        });
    }
}
