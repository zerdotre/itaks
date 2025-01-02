<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'iTaks') }}</title>
        
        @fluxStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('styles')
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        @include('components.layouts.navigation')

        <flux:main container class="!p-4 md:!p-6 lg:!p-8">

            {{ $slot }}
            
            <footer class="pt-4 md:pt-6 lg:pt-8">
                <p class="text-zinc-400">Powered by <a href="https://zer.re" target="_blank" class="underline">zer.re</a></p>
            </footer>

        </flux:main>

        <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
        @fluxScripts
        <script>window.GOOGLE_MAPS_API_KEY = "{{Config::get('googlemaps.key')}}";</script>
        @yield('scripts')
    </body>
</html>
