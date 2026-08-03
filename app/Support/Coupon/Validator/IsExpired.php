<?php

namespace App\Support\Coupon\Validator;

use App\Exceptions\CouponIsExpiredException;
use App\Models\Coupon;
use App\Support\Coupon\Validator\Contracts\AbstractCouponValidator;

class IsExpired extends AbstractCouponValidator
{
    /**
     * @throws CouponIsExpiredException
     */
    public function validate(Coupon $coupon): void
    {
        if ($coupon->isExpired()) {
            throw new CouponIsExpiredException();
        }

        parent::validate($coupon);
    }
}
