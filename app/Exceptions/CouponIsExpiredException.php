<?php

namespace App\Exceptions;

use Exception;

class CouponIsExpiredException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('alerts.error.expired', [
            'attribute' => __('attributes.discount-code')
        ]));
    }
}
