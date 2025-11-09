<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p><strong>Tarih:</strong> {{ $event->date }}</p>
                <p><strong>Konum:</strong> {{ $event->location }}</p>
                <p class="mt-2"><strong>Açıklama:</strong> {{ $event->description ?? '—' }}</p>

                <hr class="my-4">

                <h3 class="text-lg font-semibold mb-2">Bilet Türleri</h3>
                @if ($event->ticketTypes->count() > 0)
                    <ul>
                        @foreach ($event->ticketTypes as $ticket)
                            <li class="mb-2">
                                {{ $ticket->name }} - {{ $ticket->price }} €
                                @if (Auth::check() && Auth::user()->isAttendee())
                                    <form method="POST"
                                          action="{{ route('tickets.purchase', $ticket->id) }}"
                                          class="inline ml-3">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                            Bilet Al
                                        </button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Bu etkinlik için bilet tanımlanmamış.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
