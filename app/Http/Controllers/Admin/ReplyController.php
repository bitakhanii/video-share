<?php

namespace App\Http\Controllers\Admin;

use App\Events\TicketReplied;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __invoke(Request $request, Ticket $ticket): RedirectResponse
    {
        $request->validate([
            'content' => ['required', 'string'],
        ]);

        $reply = auth()->user()->replies()->create([
            'ticket_id' => $ticket->id,
            'content' => $request->content,
        ]);

        event(new TicketReplied($reply));

        return success_redirect('back', 'create', 'reply');
    }
}
