<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SaktoSched Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen bg-gray-100">
            <!-- Sidebar -->
            <div class="w-64 bg-gray-800 text-white flex flex-col">
                <div class="p-6 text-center border-b border-gray-700">
                    <h2 class="text-2xl font-bold">SaktoSched</h2>
                </div>
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.qualifications.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all">
                        <span>Qualifications</span>
                    </a>
                    <a href="{{ route('admin.inquiries.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all">
                        <span>Inquiries</span>
                    </a>
                </nav>
            </div>
            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
              <!-- This is the new, corrected code for layouts/admin.blade.php -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo can go here if needed -->
                        </div>

                        <!-- Right Side Of Navbar -->
                        <div class="flex items-center ml-6">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" class="ml-4">
                                @csrf
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                    class="text-sm text-gray-500 hover:text-gray-700">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                    <div class="container mx-auto px-6 py-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>