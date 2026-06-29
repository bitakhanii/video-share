<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
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
        $randomCategory = Category::query()->inRandomOrder()->value('id') ?? Category::factory()
            ->create();
        return [
            'name' => fake()->realText(30),

            'file' => '',

            'thumbnail' => '',

            'length' => fake()->numberBetween('5', '2000'),

            'views' => fake()->numberBetween('20', '4000'),

            'slug' => fake()->slug(),

            'description' => fake()->realText('1000'),

            'category_id' => fake()->randomElement([$randomCategory, $randomCategory,
                $randomCategory, $randomCategory, $randomCategory, $randomCategory,
                $randomCategory, $randomCategory, null]),

            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory()->create(),
        ];
    }
}
