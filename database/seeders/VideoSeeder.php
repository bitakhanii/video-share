<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $base = now()->subMonths(6);

        foreach (range(1, 30) as $number) {

            $base = $base->copy()->addDays(rand(1, 11));
            $createdAt = $base;

            Video::factory()->hasComments(rand(3, 15), function () use ($createdAt) {
                return [
                    'created_at' => fake()->dateTimeBetween($createdAt, 'now'),
                ];
            })->create([
                'file' => $number . '.MP4',
                'thumbnail' => $number . '.JPG',
                'created_at' => $createdAt,
                'updated_at' => fake()->randomElement([fake()->dateTimeBetween($createdAt, 'now'),
                    $createdAt, $createdAt, $createdAt, $createdAt]),
            ]);
        }
    }


}
