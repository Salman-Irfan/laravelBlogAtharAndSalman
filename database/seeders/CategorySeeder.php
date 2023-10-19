<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Category 1',
                'isChild' => null,
                // Null means it's not a child category
            ],
            [
                'name' => 'Category 2',
                'isChild' => 1,
                // This category is a child of the category with ID 1
            ],
            [
                'name' => 'Category 3',
                'isChild' => null,
                // Null means it's not a child category
            ],
        ];

        // Use the map method to create Category model instances and save them
        collect($categories)->map(function ($category) {
            Category::create($category);
        });
    }
}
