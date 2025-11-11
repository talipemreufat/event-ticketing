<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class EventController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            $events = Event::with('organizer')->latest()->get();
        } elseif ($user->role === 'organizer') {
            $events = Event::where(function ($query) use ($user) {
                $query->where('organizer_id', $user->id)
                      ->orWhere('created_by', $user->id);
            })->with('organizer')->latest()->get();
        } else {
            $events = Event::with('organizer')->latest()->get();
        }

        return view('events.index', compact('events'));
    }

    public function create()
    {
        $organizers = [];

        if (Auth::check() && Auth::user()->role === 'admin') {
            $organizers = User::where('role', 'organizer')->get();
        }

        return view('events.create', ['organizers' => $organizers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'organizer_id' => 'nullable|exists:users,id',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 🟢 user_id zorunlu
        $validated['user_id'] = $user->id;

        // 🟢 created_by ve organizer_id doğru şekilde atanıyor
        if ($user->role === 'admin') {
            $validated['created_by'] = $user->id;
            $validated['organizer_id'] = $request->organizer_id ?: $user->id;
        } elseif ($user->role === 'organizer') {
            $validated['created_by'] = $user->id;
            $validated['organizer_id'] = $user->id;
        } else {
            abort(403, 'You are not allowed to create events.');
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Etkinlik başarıyla oluşturuldu!');
    }

    public function show(Event $event)
    {
        $event->load(['organizer' , 'ticketTypes']);
        $user = Auth::user();
        return view('events.show', compact('event'));
    }
}
