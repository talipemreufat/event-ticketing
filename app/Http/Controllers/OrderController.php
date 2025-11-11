<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Eğer admin ise tüm siparişleri görsün
        if (Auth::user()->role === 'admin') {
            $orders = Order::with(['event', 'user'])->latest()->get();
        }
        // Organizer ise sadece kendi event'lerinin siparişlerini görsün
        elseif (Auth::user()->role === 'organizer') {
            $orders = Order::whereHas('event', function ($q) {
                $q->where('organizer_id', Auth::id());
            })->with(['event', 'user'])->get();
        }
        // Attendee ise kendi aldığı biletleri görsün
        else {
            $orders = Order::where('user_id', Auth::id())->with('event')->get();
        }

        return view('orders.index', compact('orders'));
    }
}
