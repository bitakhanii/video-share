<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\Notification\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendSms implements ShouldQueue
{
    use Queueable;

    private User $user;
    private string $text;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * Execute the job.
     * @throws \Exception
     */
    public function handle(Notification $notification)
    {
        $result = $notification->sendSms($this->user, $this->text);

        if (! $result['success']) {
            throw new \Exception($result['message']);
        }
    }
}
