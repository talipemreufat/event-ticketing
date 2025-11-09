<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        // 🔹 Tüm etkinlikleri çekiyoruz
        $events = Event::with('ticketTypes')->get();

        // 🔹 Debug için (bir kere çalıştır, sonra silebilirsin)
        // dd($events);

        // 🔹 View'a gönder
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();
        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Etkinlik başarıyla oluşturuldu!');
    }

    public function show(Event $event)
    {
        $event->load('ticketTypes');
        return view('events.show', compact('event'));
    }
}
