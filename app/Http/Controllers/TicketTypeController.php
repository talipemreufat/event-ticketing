<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\TicketType;

class TicketTypeController extends Controller
{

    public function index()
    {
    $ticketTypes = \App\Models\TicketType::with('event')->get();
    return view('ticket-types.index', compact('ticketTypes'));
    }


    public function create()
    {
    $events = Event::all();
    return view('ticket-types.create', compact('events'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        TicketType::create($validated);

        return redirect()->route('ticket-types.index')->with('success', 'Bilet türü başarıyla oluşturuldu!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
