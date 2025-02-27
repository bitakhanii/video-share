<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmail
{
    /**
     * Create the event listener.
     */

    //public $queue = 'send';

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VideoCreated $event): void
    {
        //dd($event->video->name);
        dump('This is send email listener.');
    }
}
