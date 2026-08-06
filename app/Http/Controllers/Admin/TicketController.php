<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets;
        return view('tickets.index', compact('tickets'));
    }
    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validateTicket($request);

        auth()->user()->tickets()->create(
            $request->all() + ['file_path' => $this->uploadFile($request)]
        );

        return success_redirect('back', 'create', 'ticket');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function close(Ticket $ticket): RedirectResponse
    {
        $ticket->close();
        return success_redirect('back', 'close', 'ticket');
    }

    private function validateTicket(Request $request): void
    {
        $request->validate([
            'title' => ['required', 'string'],
            'department' => ['required', 'numeric'],
            'priority' => ['required', 'numeric'],
            'content' => ['required'],
        ]);;
    }

    private function uploadFile($request)
    {
        return $request->hasFile('file')
            ? $request->file->store('tickets')
            : null;
    }
}
