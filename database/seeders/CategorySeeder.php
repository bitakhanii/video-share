<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            'فیلم و سریال' => [
                'slug' => 'movies-series',
                'icon' => 'fa fa-film',
                'description' => 'فیلم‌ها و سریال‌های ایرانی و خارجی'
            ],
            'مستند' => [
                'slug' => 'documentary',
                'icon' => 'fa fa-video-camera',
                'description' => 'مستندهای علمی، تاریخی و طبیعت'
            ],
            'آموزشی' => [
                'slug' => 'educational',
                'icon' => 'fa fa-book',
                'description' => 'ویدئوهای آموزشی در حوزه‌های مختلف'
            ],
            'موزیک' => [
                'slug' => 'music',
                'icon' => 'fa fa-music',
                'description' => 'موزیک ویدئو و کنسرت‌ها'
            ],
            'کودک و نوجوان' => [
                'slug' => 'kids',
                'icon' => 'fa fa-child',
                'description' => 'انیمیشن و برنامه‌های کودکانه'
            ],
            'ورزشی' => [
                'slug' => 'sports',
                'icon' => 'fa fa-trophy',
                'description' => 'مسابقات و برنامه‌های ورزشی'
            ],
            'طنز و سرگرمی' => [
                'slug' => 'comedy',
                'icon' => 'fa fa-smile-o',
                'description' => 'برنامه‌های طنز و سرگرمی'
            ],
            'فناوری' => [
                'slug' => 'technology',
                'icon' => 'fa fa-laptop',
                'description' => 'بررسی و آموزش فناوری و گجت'
            ],
            'آشپزی' => [
                'slug' => 'cooking',
                'icon' => 'fa fa-cutlery',
                'description' => 'آموزش آشپزی و دستور پخت'
            ],
        ];

        foreach ($categories as $categoryName => $details) {
            Category::create([
                'name' => $categoryName,
                'slug' => $details['slug'],
                'icon' => $details['icon'],
                'description' => $details['description'],
            ]);
        }
    }
}
