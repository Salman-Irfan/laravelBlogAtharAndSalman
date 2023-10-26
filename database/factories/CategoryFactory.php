<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
       
        return [
            'name' =>$this->faker->word,
            'isChild' => function () {
                return Category::inRandomOrder()->first();
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
