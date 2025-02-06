<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\Notification\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendSms implements ShouldQueue
{
    use Queueable;

    private $user;
    private $text;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, String $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * Execute the job.
     */
    public function handle(Notification $notification)
    {
        $notification->sendSms($this->user, $this->text);
    }
}
