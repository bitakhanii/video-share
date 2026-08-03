<?php

namespace App\Support\Coupon\Validator\Contracts;

use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{
    private CouponValidatorInterface $nextValidator;
    public function setNextValidator(CouponValidatorInterface $validator): void
    {
        $this->nextValidator = $validator;
    }

    public function validate(Coupon $coupon)
    {
        if (!isset($this->nextValidator)) {
            return true;
        }

        $this->nextValidator->validate($coupon);
    }
}
