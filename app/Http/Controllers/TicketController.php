<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TicketType;
use App\Models\Order;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->with('event')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function purchase($ticketTypeId)
    {
        $ticketType = TicketType::findOrFail($ticketTypeId);

        // Bilet stoğu kalmamışsa
        if ($ticketType->quantity <= 0) {
            return back()->with('error', 'This ticket type is sold out.');
        }

        // Order kaydı oluştur
        $order = Order::create([
            'user_id'     => Auth::id(),
            'event_id'    => $ticketType->event_id,
            'total_price' => $ticketType->price,
            'status'      => 'paid',
        ]);

        // Ticket kaydı oluştur
        Ticket::create([
            'user_id'     => Auth::id(),
            'event_id'    => $ticketType->event_id,
            'ticket_type_id' => $ticketType->id,
            'order_id'    => $order->id,
            'total_price' => $ticketType->price,
            'is_checked_in' => false,
        ]);

        // Bilet stoğunu azalt
        $ticketType->decrement('quantity');

        return redirect()->route('tickets.index')->with('success', 'Ticket purchased successfully!');
    }
}
