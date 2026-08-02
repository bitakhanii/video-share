<?php

namespace App\Models;

use App\Support\Coupon\DiscountManager;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'image',
    ];

    /* Accessor Methods */
    public function image(): Attribute
    {
        return Attribute::get(function ($value) {
            return Storage::url('products/' . $value);
        });
    }

    /* End Accessor Methods */

    public function hasStock(int $quantity): bool
    {
        return $this->stock >= $quantity;
    }

    /* Relation Methods */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    /* End Relation Methods */

    public function decrementStock(int $count): int
    {
        return $this->decrement('stock', $count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDiscountedPriceAttribute()
    {
        $coupons = $this->category->validCategoryCoupons();
        $discountManager = new DiscountManager();

        return $coupons->isNotEmpty()
            ? $discountManager->finalAmount($coupons->first(), $this->price)
            : $this->price;
    }
}
