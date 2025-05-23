<?php

namespace App\Support\Coupon\Traits;

use App\Models\Coupon;
use Carbon\Carbon;

trait Couponable
{
    public function coupons()
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }

    public function validCategoryCoupons()
    {
        return $this->coupons->where('expire_time', '>', Carbon::now());
    }
}
