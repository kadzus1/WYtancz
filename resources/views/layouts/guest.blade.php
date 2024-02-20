<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WYtańcz') }}</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('storage/css/images/icon.png') }}">
        
     
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        
        
        <!-- Scripts -->
        <link href="/css/app.css" rel="stylesheet">
        <script src="/js/app.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <a href="{{ route('welcome') }}" class="back-link ml-2">
            <i class="fas fa-arrow-left"></i> Powrót do strony głównej
        </a>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-white ">
            

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
