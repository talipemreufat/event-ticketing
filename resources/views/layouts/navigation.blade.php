<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
  
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto text-gray-800" />
                    </a>
                </div>

  
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

               
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                        {{ __('Events') }}
                    </x-nav-link>

                    
                    @auth
                        @if(Auth::user()->role === 'organizer')
                            <x-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')">
                                {{ __('Create Event') }}
                            </x-nav-link>

                            <x-nav-link :href="route('ticket-types.index')" :active="request()->routeIs('ticket-types.index')">
                                {{ __('Ticket Types') }}
                            </x-nav-link>

                            <x-nav-link :href="route('ticket-types.create')" :active="request()->routeIs('ticket-types.create')">
                                {{ __('Create Ticket Type') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    
                    @auth
                        @if(Auth::user()->role === 'attendee')
                            <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.index')">
                                🎟️ {{ __('My Tickets') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                     
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
