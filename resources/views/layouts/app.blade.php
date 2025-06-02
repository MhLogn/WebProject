<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'CarZone' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        @include('layouts.navigation')

        <!-- Header -->
        @isset($header)
            <header class="bg-gray-800 text-white shadow">
                <div class="container mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-2xl font-semibold">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main class="bg-gray-200">
            <div class="container mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-sm font-semibold text-center py-4 flex">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                © 2025 CarZone. All rights reserved.
            </div>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex-r">
                <a href="{{ route('contact', ['id' => 1]) }}" class="inline-block bg-green-500 hover:bg-green-600 font-semibold py-2 px-4 rounded border border-gray-500">
                    Liên hệ
                </a>
            </div>
        </footer>
    </div>
</body>
</html>
