<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Providers\Contracts\Provider;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class Email implements Provider
{
    private User $user;
    private Mailable $mailable;

    public function __construct(User $user, Mailable $mailable)
    {
        $this->user = $user;
        $this->mailable = $mailable;
    }

    public function send(): void
    {
        Mail::to($this->user->email)->send($this->mailable);
    }
}
