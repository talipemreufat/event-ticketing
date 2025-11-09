<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🎟️ Purchased Tickets') }}
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

                @if($orders->isEmpty())
                    <div class="text-center py-8 text-gray-600">
                        <p class="text-lg">Henüz hiç bilet satın almadın 🎫</p>
                        <a href="{{ route('events.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700">
                            Etkinlikleri Gör
                        </a>
                    </div>
                @else
                    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Etkinlik</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Tarih</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Konum</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Toplam Fiyat (TL)</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Durum</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-800 font-medium">
                                        {{ $order->event->title }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($order->event->date)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $order->event->location }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-800 font-semibold">
                                        {{ number_format($order->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->status === 'paid')
                                            <span class="bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full">Ödendi</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 text-sm font-semibold px-3 py-1 rounded-full">{{ ucfirst($order->status) }}</span>
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
