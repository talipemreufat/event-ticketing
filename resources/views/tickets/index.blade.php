<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🎟️ My Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if($tickets->isEmpty())
                    <div class="text-center py-8 text-gray-600">
                        <p class="text-lg">You haven't purchased any tickets yet 🎫</p>
                        <a href="{{ route('events.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700">
                            Browse Events
                        </a>
                    </div>
                @else
                    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Event</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Location</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Ticket Type</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Total Price (TL)</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($tickets as $ticket)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-800 font-medium">
                                        {{ $ticket->event->title ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $ticket->event->date ? \Carbon\Carbon::parse($ticket->event->date)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $ticket->event->location ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $ticket->ticketType->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-800 font-semibold">
                                        {{ number_format($ticket->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($ticket->is_checked_in)
                                            <span class="bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full">Checked In</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 text-sm font-semibold px-3 py-1 rounded-full">Active</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
