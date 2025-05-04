<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(35),
            'description' => fake()->realText(1000),
            'price' => fake()->numberBetween(10, 5000) . '000',
            'category_id' => Category::all()->random()->id,
            'stock' => fake()->numberBetween(0, 10),
            'image' => 'https://picsum.photos/320/240?random=' . rand(1, 120),
        ];
    }
}
