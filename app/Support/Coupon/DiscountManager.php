<?php

namespace App\Support\Coupon;

use App\Models\Coupon;

class DiscountManager
{
    public function calculateDiscount($totalAmount)
    {
        if (!session()->has('coupon')) return 0;

        $coupon = session()->get('coupon');
        $code = Coupon::where('code', $coupon)->first();
        return $this->discountAmount($code, $totalAmount);
    }

    public function finalAmount($code, $totalAmount)
    {
        return $totalAmount - $this->discountAmount($code, $totalAmount);
    }

    private function discountAmount($code, $totalAmount)
    {
        $discountAmount = (int) (($code->percent / 100) * $totalAmount);
        return $discountAmount > $code->limit ? $code->limit : $discountAmount;
    }

}
