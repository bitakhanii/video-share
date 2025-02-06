<?php

namespace App\Services\Notification\Constants;

use App\Mail\ForgetPassword;
use App\Mail\UserRegistered;
use App\Mail\VideoCreated;

class EmailTypes
{
    const USER_REGISTERED = 1;
    const VIDEO_CREATED = 2;
    const  FORGET_PASSWORD = 3;

    public static function toString()
    {
        return [
            self::USER_REGISTERED => 'ثبت نام کاربر',
            self::VIDEO_CREATED => 'ساختن ویدئو',
            self::FORGET_PASSWORD => 'فراموشی رمز عبور',
        ];
    }

    public static function toMail($type)
    {
        return [
            self::USER_REGISTERED => UserRegistered::class,
            self::VIDEO_CREATED => VideoCreated::class,
            self::FORGET_PASSWORD => ForgetPassword::class,
        ][$type];
    }
}
