<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'video_id' => Video::query()->inRandomOrder()->first() ?? Video::factory()->create(),
            'user_id' => User::query()->inRandomOrder()->first() ?? User::factory()->create(),
            'body' => fake()->realText('500'),
        ];
    }
}
