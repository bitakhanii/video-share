<?php

namespace App\Http\Controllers;

use App\Events\TicketReplid;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $reply = auth()->user()->replies()->create([
            'ticket_id' => $ticket->id,
            'content' => $request->content,
        ]);

        event(new TicketReplid($reply));

        return back();
    }
}
