<?php

namespace App\Exceptions;

use Exception;

class IsNotBelongsToUserException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('alerts.error.not-belongs-to-you', [
            'attribute' => __('attributes.discount-code')
        ]));
    }
}
