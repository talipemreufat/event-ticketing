<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yeni Etkinlik Oluştur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="title" class="block font-medium text-sm text-gray-700">Başlık</label>
                        <input type="text" name="title" id="title" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Açıklama</label>
                        <textarea name="description" id="description" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <div class="mt-4">
                        <label for="location" class="block font-medium text-sm text-gray-700">Konum</label>
                        <input type="text" name="location" id="location" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mt-4">
                        <label for="date" class="block font-medium text-sm text-gray-700">Tarih</label>
                        <input type="date" name="date" id="date" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mt-4">
                        <label for="image" class="block font-medium text-sm text-gray-700">Kapak Görseli</label>
                        <input type="file" name="image" id="image" class="block w-full mt-1">
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Kaydet</button>
                        <a href="{{ route('events.index') }}" class="ml-2 text-gray-600">Vazgeç</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
EOF
