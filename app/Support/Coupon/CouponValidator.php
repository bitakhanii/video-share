<?php

namespace App\Support\Coupon;

use App\Exceptions\CouponIsExpiredException;
use App\Models\Coupon;
use App\Support\Coupon\Validator\IsBelongsToUser;
use App\Support\Coupon\Validator\IsExpired;

class CouponValidator
{
    /**
     * @throws CouponIsExpiredException
     */
    public function isValid(Coupon $coupon): void
    {
        $isExpired = new IsExpired();
        $isBelongsToUser = new IsBelongsToUser();

        $isExpired->setNextValidator($isBelongsToUser);

        $isExpired->validate($coupon);
    }
}
