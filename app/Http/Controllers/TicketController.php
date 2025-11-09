<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TicketType;
use App\Models\Order;

class TicketController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('event')->get();
        return view('tickets.index', compact('orders'));
    }

    public function purchase($ticketTypeId)
    {
        $ticketType = TicketType::findOrFail($ticketTypeId);

        
        if ($ticketType->quantity <= 0) {
            return back()->with('error', 'Bu bilet tükenmiştir.');
        }

        
        $order = Order::create([
            'user_id'     => Auth::id(),
            'event_id'    => $ticketType->event_id, 
            'total_price' => $ticketType->price,
            'status'      => 'paid', 
        ]);

        
        $ticketType->decrement('quantity');

        return redirect()->route('tickets.index')->with('success', 'Bilet başarıyla satın alındı!');
    }
}
