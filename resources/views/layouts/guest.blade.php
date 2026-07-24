<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Iuran') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-stone-800 antialiased">
        <!-- Background krem hangat (Lofi vibe) -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#fdfbf7]">
            <div>
                <a href="/">
                    <div class="w-20 h-20 bg-[#d4a373] text-white rounded-full flex items-center justify-center text-2xl font-bold shadow-lg">
                        BA
                    </div>
                </a>
                <h2 class="mt-4 text-center text-xl font-semibold text-stone-600">Perumahan Bumi Agung</h2>
            </div>

            <!-- Card dengan warna off-white dan shadow lembut -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-[#fffaf4] border border-stone-200 shadow-[0_4px_20px_rgba(0,0,0,0.05)] sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
