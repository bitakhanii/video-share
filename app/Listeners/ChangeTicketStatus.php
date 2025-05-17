<?php

namespace App\Listeners;

use App\Events\TicketReplid;
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
    public function handle(TicketReplid $event): void
    {
        if ($event->reply->ticket->isCreated() && $event->user->isAdmin()) {
            $event->reply->ticket->replied();
        }
    }
}
