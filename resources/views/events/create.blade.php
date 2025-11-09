<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yeni Etkinlik Oluştur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('events.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Başlık</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Açıklama</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-md" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Konum</label>
                        <input type="text" name="location" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Tarih</label>
                        <input type="date" name="date" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                            Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
