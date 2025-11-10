<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('event')->orderBy('created_at', 'desc')->get();
        return view('organizer.checkin.index', compact('tickets'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|integer'
        ]);

        $ticket = Ticket::find($request->ticket_id);

        if (!$ticket) {
            return back()->with('error', 'Ticket not found!');
        }

        if ($ticket->is_checked_in) {
            return back()->with('error', 'This ticket has already been checked in!');
        }

        $ticket->update([
            'is_checked_in' => true,
            'checked_in_at' => now(),
        ]);

        return back()->with('success', 'Ticket successfully verified and checked in!');
    }
}
