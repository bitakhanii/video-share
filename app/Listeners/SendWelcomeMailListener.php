<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailListener
{
    public function __construct()
    {
    }

    public function handle(UserRegistered $event): void
    {
        Mail::to($event->user)->send(new \App\Mail\UserRegistered($event->user));
    }
}
