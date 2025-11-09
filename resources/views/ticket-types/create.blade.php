<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yeni Bilet Türü Oluştur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('ticket-types.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="event_id" class="block text-sm font-medium text-gray-700">Etkinlik</label>
                        <select name="event_id" id="event_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Bilet Türü Adı</label>
                        <input type="text" name="name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Fiyat (TL)</label>
                        <input type="number" step="0.01" name="price" id="price" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Adet</label>
                        <input type="number" name="quantity" id="quantity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Kaydet
                        </button>
                        <a href="{{ route('ticket-types.index') }}" class="ml-2 text-gray-600">
                            Vazgeç
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
