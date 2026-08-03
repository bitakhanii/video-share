<?php

namespace App\Support\Coupon\Traits;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Couponable
{
    /* Relation Methods */
    public function coupons(): MorphMany
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }

    /* End Relation Methods */

    public function validCategoryCoupons()
    {
        return $this->coupons->where('expire_time', '>', Carbon::now());
    }
}
