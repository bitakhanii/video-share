<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $likeable = $this->likeable();
        return [
            'user_id' => User::query()->inRandomOrder()->first() ?? User::factory()->create(),
            'likeable_type' => $likeable,
            'likeable_id' => $likeable::query()->inRandomOrder()->first() ?? $likeable::factory()->create(),
            'vote' => $this->faker->randomElement([1, -1]),
        ];
    }

    private function likeable()
    {
        return $this->faker->randomElement([
            Comment::class,
        ]);
    }
}
