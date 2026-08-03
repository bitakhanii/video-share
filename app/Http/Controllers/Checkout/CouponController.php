<?php

namespace App\Http\Controllers\Checkout;

use App\Exceptions\CouponIsExpiredException;
use App\Exceptions\IsNotBelongsToUserException;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Support\Coupon\CouponValidator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private CouponValidator $validator;

    public function __construct(CouponValidator $validator)
    {
        $this->validator = $validator;
    }

    public function apply(Request $request): RedirectResponse
    {
        $request->validate([
            'coupon' => ['required', 'exists:coupons,code'],
        ], [
            'coupon.required' => 'کد تخفیف خود را وارد نمائید'
        ]);

        $coupon = Coupon::where('code', '=', $request->coupon)->firstOrFail();

        try {
            $this->validator->isValid($coupon);
        } catch (CouponIsExpiredException|IsNotBelongsToUserException $e) {
            return back()->withErrors(['coupon' => $e->getMessage()])->withInput();
        }

        session()->put(['coupon' => $coupon->code]);
        return success_redirect('back', 'apply', 'discount-code');
    }

    public function remove(): RedirectResponse
    {
        session()->forget('coupon');
        return back();
    }
}
