<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailListener implements ShouldQueue
{
    use Queueable;

    public function handle(UserRegistered $event): void
    {
        Mail::to($event->user)->send(new \App\Mail\UserRegistered($event->user));
    }
}
