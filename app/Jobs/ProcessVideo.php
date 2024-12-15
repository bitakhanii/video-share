<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ProcessVideo implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('process');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::raw('Process Video Test', function ($message) {
           $message->to('xbitaw99@gmail.com');
        });
    }
}
