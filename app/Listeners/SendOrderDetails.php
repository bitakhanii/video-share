<?php

namespace App\Listeners;

use App\Events\OrderRegistered;
use App\Mail\OrderDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderDetails implements ShouldQueue
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
    public function handle(OrderRegistered $event): void
    {
        Mail::to($event->order->user)->send(new OrderDetails($event->order));
    }
}
