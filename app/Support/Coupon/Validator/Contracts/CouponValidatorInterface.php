<?php

namespace App\Support\Coupon\Validator\Contracts;
use App\Models\Coupon;

interface CouponValidatorInterface
{
    public function setNextValidator(CouponValidatorInterface $validator);

    public function validate(Coupon $coupon);
}
