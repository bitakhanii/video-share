<?php

namespace App\Services\Notification\Providers;

use App\Services\Notification\Exceptions\UserDoesNotHavePhoneNumber;
use App\Services\Notification\Providers\Contracts\Provider;

class Sms implements Provider
{
    private $user;
    private $text;

    public function __construct($user, $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * @throws UserDoesNotHavePhoneNumber
     */
    public function send()
    {
        if (is_null($this->user->phone_number)) {
            throw new UserDoesNotHavePhoneNumber();
        }
        return 'Sms: ' . $this->text . ' sent successfully to ' . $this->user->name;
    }
}
