<?php

namespace App\Listeners;

use App\Events\TicketReplied;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeTicketStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketReplied $event): void
    {
        if ($event->reply->ticket->isCreated() && auth('admin')->check()) {
            $event->reply->ticket->replied();
        }
    }
}
