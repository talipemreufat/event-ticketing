<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @if($orders->isEmpty())
                    <p class="text-center text-gray-600">No orders found.</p>
                @else
                    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Event</th>
                                <th class="px-6 py-3 text-left">Customer</th>
                                <th class="px-6 py-3 text-left">Total Price</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr>
                                    <td class="px-6 py-4">{{ $order->event->title ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $order->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ number_format($order->total_price, 2) }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($order->status) }}</td>
                                    <td class="px-6 py-4">{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
