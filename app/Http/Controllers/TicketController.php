<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
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

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'department' => ['required', 'numeric'],
            'priority' => ['required', 'numeric'],
            'content' => ['required'],
        ]);

        auth()->user()->tickets()->create(
            $request->all() + ['file_path' => $this->uploadFile($request)]
        );

        return back()->with([
            'alert' => __('alerts.success.create', ['attribute' => 'تیکت']),
            'alert-type' => 'success',
        ]);
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function close(Ticket $ticket)
    {
        $ticket->close();
        return back();
    }

    private function uploadFile($request)
    {
        return $request->hasFile('file')
            ? $request->file->store('tickets')
            : null;
    }
}
