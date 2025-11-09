<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bilet Türleri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <a href="{{ route('ticket-types.create') }}" 
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                   + Yeni Bilet Türü
                </a>

                @if(session('success'))
                    <div class="mt-4 text-green-700 font-semibold">{{ session('success') }}</div>
                @endif

                <table class="w-full mt-6 border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border p-2">Etkinlik</th>
                            <th class="border p-2">Ad</th>
                            <th class="border p-2">Fiyat (TL)</th>
                            <th class="border p-2">Adet</th>
                            <th class="border p-2">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ticketTypes as $ticket)
                            <tr>
                                <td class="border p-2">{{ $ticket->event->title ?? '—' }}</td>
                                <td class="border p-2">{{ $ticket->name }}</td>
                                <td class="border p-2">{{ $ticket->price }}</td>
                                <td class="border p-2">{{ $ticket->quantity }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('ticket-types.edit', $ticket) }}" 
                                       class="text-blue-600 hover:underline">Düzenle</a>
                                    <form action="{{ route('ticket-types.destroy', $ticket) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-600">Henüz kayıtlı bilet türü yok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
