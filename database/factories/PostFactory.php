<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => null, // Generates a random image URL
            'category_id' => \App\Models\Category::factory(),
            'user_id' => \App\Models\User::factory(),
            'isApproved' => $this->faker->boolean(75), // 75% chance of being approved
        ];
    }
}
