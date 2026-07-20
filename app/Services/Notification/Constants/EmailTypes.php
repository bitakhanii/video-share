<?php

namespace App\Services\Notification\Constants;

use App\Mail\ForgetPassword;
use App\Mail\UserRegistered;

class EmailTypes
{
    const USER_REGISTERED = 1;
    const  FORGET_PASSWORD = 2;

    public static function toString(): array
    {
        return [
            self::USER_REGISTERED => 'ثبت نام کاربر',
            self::FORGET_PASSWORD => 'فراموشی رمز عبور',
        ];
    }

    public static function toMail($type, $data)
    {
        try {
            return [
                self::USER_REGISTERED => new UserRegistered($data['user']),
                self::FORGET_PASSWORD => new ForgetPassword($data['user']),
            ][$type];
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
