<?php

namespace App\Models;

use App\Support\Coupon\DiscountManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function hasStock(int $quantity)
    {
        return $this->stock >= $quantity;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function decrementStock(int $count)
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
