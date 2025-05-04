<?php

namespace App\Support\Coupon\Validator\Contracts;

use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{
    private $nextValidator;
    public function setNextValidator(CouponValidatorInterface $validator)
    {
        $this->nextValidator = $validator;
    }

    public function validate(Coupon $coupon)
    {
        if ($this->nextValidator == null) {
            return true;
        }

        $this->nextValidator->validate($coupon);
    }
}
