<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Toplam Etkinlik</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalEvents }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Toplam Organizatör</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalOrganizers }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Tanımlı Bilet Türleri</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalTickets }}</p>
                </div>

            </div>

            <div class="mt-10 bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Hızlı Erişim</h3>
                <div class="flex gap-4">
                    <a href="{{ route('events.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Etkinlikleri Gör
                    </a>
                    <a href="{{ route('ticket-types.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Bilet Türlerini Gör
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
