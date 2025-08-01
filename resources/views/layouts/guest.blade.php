<?php

//======================================================================
// SPRINT 8 FIX: ADD MISSING GUEST LAYOUT
//======================================================================
//
// GOAL: To fix the "View [layouts.guest] not found" error by creating
// the missing guest layout file that is required by the login form
// components.
//
//======================================================================


//======================================================================
// STEP 1: CREATE THE GUEST LAYOUT FILE
//======================================================================
//
// PURPOSE: This file is the master template for all pages that are
// accessible to non-logged-in users, such as the login and registration
// pages. Laravel Breeze's form components depend on this file.
//
// INSTRUCTION: In your project, navigate to the `resources/views/layouts`
// folder. Create a new file inside it named `guest.blade.php`.
//
// Paste the following code into this new file.
//
?>
<!-- FILE: resources/views/layouts/  -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

 