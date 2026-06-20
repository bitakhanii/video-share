<?php

namespace App\Models;

use App\Support\Coupon\Traits\Couponable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory, Couponable;


    protected $fillable = [
        'name', 'slug', 'icon', 'description',
    ];

    /* Relation Methods */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
    /* End Relation Methods */

    public function getRandomVideos(int $count): Collection
    {
        return $this->videos()->with(['user', 'category'])->inRandomOrder()->limit($count)->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
