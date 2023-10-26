<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'comment' =>$this->faker->sentence,
        'user_id' => function () {
            return \App\Models\User::inRandomOrder()->first()->id;
        },
        'post_id' => function () {
            return \App\Models\Post::inRandomOrder()->first()->id;
        },
        'created_at' => now(),
        'updated_at' => now(),
        ];
    }
}
