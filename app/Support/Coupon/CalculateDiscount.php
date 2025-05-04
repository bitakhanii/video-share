<?php

namespace App\Support\Coupon;

use App\Models\Coupon;

class CalculateDiscount
{
    public function discountAmount($code, $totalCosts)
    {
        $code = Coupon::where('code', $code)->first();
        $discount = (int) (($code->percent / 100) * $totalCosts);

        return $discount > $code->limit ? $code->limit : $discount;
    }
}
