<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Etkinlik Listesi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- DEBUG amaçlı --}}
                <p class="text-sm text-gray-500 mb-3">
                    Toplam etkinlik sayısı: {{ $events->count() }}
                </p>

                {{-- Organizer ise yeni etkinlik oluşturma butonu --}}
                @if (Auth::check() && Auth::user()->isOrganizer())
                    <a href="{{ route('events.create') }}"
                       class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                        Yeni Etkinlik Oluştur
                    </a>
                @endif

                {{-- Eğer hiç etkinlik yoksa mesaj göster --}}
                @if ($events->isEmpty())
                    <p class="mt-6 text-gray-500">Henüz etkinlik yok.</p>
                @else
                    <table class="mt-6 w-full border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-100">
                                <th class="px-4 py-2 text-left">Başlık</th>
                                <th class="px-4 py-2 text-left">Tarih</th>
                                <th class="px-4 py-2 text-left">Konum</th>
                                <th class="px-4 py-2 text-left">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 font-semibold">
                                        {{ $event->title }}
                                    </td>
                                    <td class="px-4 py-2">{{ $event->date }}</td>
                                    <td class="px-4 py-2">{{ $event->location }}</td>
                                    <td class="px-4 py-2">
                                        {{-- Organizer işlemleri --}}
                                        @if (Auth::user()->isOrganizer())
                                            <a href="{{ route('events.edit', $event) }}" class="text-blue-600">Düzenle</a> |
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600"
                                                    onclick="return confirm('Silmek istediğine emin misin?')">
                                                    Sil
                                                </button>
                                            </form>
                                        @else
                                            {{-- Attendee işlemleri --}}
                                            @if ($event->ticketTypes && $event->ticketTypes->count() > 0)
                                                <form method="POST"
                                                      action="{{ route('tickets.purchase', $event->ticketTypes->first()->id) }}"
                                                      class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                                        Bilet Al
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">Bilet Yok</span>
                                            @endif
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
