<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\TicketType;

class TicketTypeController extends Controller
{
    /**
     * Bilet türlerini listele
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // 🟢 Admin tüm bilet türlerini görebilir
            $ticketTypes = TicketType::with('event')->get();

        } elseif ($user->role === 'organizer') {
            // 🟠 Organizer sadece kendi veya admin tarafından kendisine atanmış eventlere ait bilet türlerini görür
            $ticketTypes = TicketType::whereHas('event', function ($query) use ($user) {
                $query->where(function ($sub) use ($user) {
                    $sub->where('organizer_id', $user->id)
                        ->orWhere('created_by', $user->id);
                });
            })
            ->with('event')
            ->get();

        } else {
            // 🔴 Attendee erişemez
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }

        return view('ticket-types.index', compact('ticketTypes'));
    }

    /**
     * Yeni bilet türü oluşturma formu
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // 🟢 Admin tüm eventleri görebilir
            $events = Event::with('organizer')->get();

        } elseif ($user->role === 'organizer') {
            // 🟠 Organizer sadece kendi veya adminin ona atadığı eventleri görebilir
            $events = Event::where(function ($query) use ($user) {
                $query->where('organizer_id', $user->id)
                      ->orWhere('created_by', $user->id);
            })
            ->with('organizer')
            ->get();

        } else {
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }

        return view('ticket-types.create', compact('events'));
    }

    /**
     * Bilet türünü kaydet
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        // 🟢 Yeni bilet türünü oluştur
        TicketType::create($validated);

        return redirect()
            ->route('ticket-types.index')
            ->with('success', 'Bilet türü başarıyla oluşturuldu!');
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
