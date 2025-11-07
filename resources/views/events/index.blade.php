<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Etkinlik Listesi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('events.create') }}" class="bg-indigo-500 text-white px-4 py-2 rounded">Yeni Etkinlik Oluştur</a>

                <table class="mt-6 w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Başlık</th>
                            <th class="px-4 py-2 text-left">Tarih</th>
                            <th class="px-4 py-2 text-left">Konum</th>
                            <th class="px-4 py-2 text-left">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $event->title }}</td>
                                <td class="px-4 py-2">{{ $event->date }}</td>
                                <td class="px-4 py-2">{{ $event->location }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('events.edit', $event) }}" class="text-blue-500">Düzenle</a> |
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500" onclick="return confirm('Silmek istediğine emin misin?')">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Henüz etkinlik yok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
EOF
