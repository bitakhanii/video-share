<?php

namespace App\Services\Notification\Providers;

use App\Services\Notification\Providers\Contracts\Provider;
use Illuminate\Support\Facades\Mail;

class Email implements Provider
{
    private $user;
    private $mailable;

    public function __construct($user, $mailable)
    {
        $this->user = $user;
        $this->mailable = $mailable;
    }

    public function send()
    {
        Mail::to($this->user->email)->send($this->mailable);
    }
}
