<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'category_id' => $this->faker->randomNumber(1, 10),
            'user_id' => $this->faker->randomNumber(1, 10),
            'isApproved' => $this->faker->boolean,
        ];
    }
}

