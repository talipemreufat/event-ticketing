<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎫 Ticket Check-In
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Mesajlar --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('checkin.verify') }}" class="mb-8">
                    @csrf
                    <label for="ticket_id" class="block text-sm font-medium text-gray-700">Enter Ticket ID</label>
                    <input type="text" name="ticket_id" id="ticket_id" class="mt-1 p-2 border rounded w-full" placeholder="e.g. 1, 2, 3">
                    <button type="submit" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded">
                        Verify Ticket
                    </button>
                </form>

                {{-- Ticket Listesi --}}
                <table class="min-w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Event</th>
                            <th class="px-4 py-2 text-left">User</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Checked In</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $ticket->id }}</td>
                                <td class="px-4 py-2">{{ $ticket->event->title ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $ticket->user->name ?? 'Unknown' }}</td>
                                <td class="px-4 py-2">
                                    {{ $ticket->is_checked_in ? '✅ Checked In' : '⏳ Not Checked' }}
                                </td>
                                <td class="px-4 py-2">{{ $ticket->checked_in_at ? $ticket->checked_in_at->format('d M Y H:i') : '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
