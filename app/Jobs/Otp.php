<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class Otp implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('otp');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::raw('OTP Test', function ($message) {
            $message->to('bita@gmail.com');
        });
    }
}
