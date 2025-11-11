<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('events.store') }}">
                    @csrf

                    {{-- Only show organizer selection if user is admin --}}
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Select Organizer</label>
                            <select name="organizer_id" class="w-full border-gray-300 rounded-md">
                                <option value="">— Choose Organizer —</option>
                                @foreach($organizers as $organizer)
                                    <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Title</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-md" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Location</label>
                        <input type="text" name="location" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Date</label>
                        <input type="date" name="date" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
