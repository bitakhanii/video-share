<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Support\Coupon\CouponValidator;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $validator;

    public function __construct(CouponValidator $validator)
    {
        $this->validator = $validator;
    }

    public function apply(Request $request)
    {
        try {
            $request->validate([
                'coupon' => ['required', 'exists:coupons,code'],
            ]);

            $coupon = Coupon::where('code', '=', $request->coupon)->firstOrFail();

            $this->validator->isValid($coupon);

            session()->put(['coupon' => $coupon->code]);
            return redirect()->back()->with([
                'alert' => __('alerts.success.apply', ['attribute' => 'کد تخفیف']),
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['کد تخفیف وارد شده نامعتبر می‌باشد']);
        }
    }

    public function remove()
    {
        session()->forget('coupon');
        return back();
    }
}
