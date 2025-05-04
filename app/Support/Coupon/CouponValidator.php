<?php

namespace App\Support\Coupon;

use App\Models\Coupon;
use App\Support\Coupon\Validator\IsBelongsToUser;
use App\Support\Coupon\Validator\IsExpired;

class CouponValidator
{
    public function isValid(Coupon $coupon)
    {
        $isExpired = new IsExpired();
        $isBelongsToUser = new IsBelongsToUser();

        $isExpired->setNextValidator($isBelongsToUser);

        $isExpired->validate($coupon);
    }
}
