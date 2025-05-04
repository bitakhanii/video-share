<?php

namespace App\Support\Coupon\Validator;

use App\Exceptions\IsNotBelongsToUserException;
use App\Models\Coupon;
use App\Support\Coupon\Validator\Contracts\AbstractCouponValidator;

class IsBelongsToUser extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {
        if (!auth()->user()->coupons->contains($coupon)) {
            throw new IsNotBelongsToUserException();
        }

        parent::validate($coupon);
    }
}
