<!-- FILE: resources/views/layouts/navigation.blade.php -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <div class="flex items-center space-x-2">
                             <img src="{{ asset('images/logo.png') }}" alt="GEST AAC Inc. Logo" class="h-12">
                            <span style="font-family: 'Poppins', sans-serif;" class="hidden sm:block text-2xl font-bold text-[#00575A]">SaktoSched</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Find a Qualification') }}
                    </x-nav-link>
                    <x-nav-link href="#">
                        {{ __('Track Inquiry') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Buttons -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                 <a href="{{ route('inquiry.create') }}" class="inline-block bg-[#00575A] text-white font-bold py-2 px-4 rounded-lg shadow-sm hover:bg-opacity-90 transition-all">
                    Book for a Group/School
                </a>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Find a Qualification') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                {{ __('Track Inquiry') }}
            </x-responsive-nav-link>
             <x-responsive-nav-link :href="route('inquiry.create')">
                {{ __('Book for a Group/School') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>