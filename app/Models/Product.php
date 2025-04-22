<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
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
}
