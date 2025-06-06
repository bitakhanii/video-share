<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();
        //Product::factory(30)->create();
        Article::factory(12)->create();

       //Video::factory(20)->hasComments(3)->hasLikes(5)->create();
        //Category::factory(2)->create();
        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
