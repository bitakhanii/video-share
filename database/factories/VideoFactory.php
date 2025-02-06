<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->realText(30),
            'file' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
            'thumbnail' => 'https://picsum.photos/320/240?random=' . rand(1, 120),
            'length' => fake()->numberBetween('5', '20000'),
            'slug' => fake()->slug(),
            'description' => fake()->realText('1000'),
            'category_id' => Category::query()->inRandomOrder()->first() ?? Category::factory()->create(),
            'user_id' => User::query()->inRandomOrder()->first() ?? User::factory()->create(),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
