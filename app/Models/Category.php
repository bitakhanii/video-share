<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;


    protected $fillable = [
        'name', 'slug', 'icon', 'description',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function getRandomVideos(int $count)
    {
        return $this->videos()->with(['user', 'category'])->inRandomOrder()->limit($count)->get();
    }
}
