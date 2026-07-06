<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 antialiased">

    <div class="flex min-h-screen">

        @include('layouts.sidebar')

        <div class="ml-0 flex flex-1 flex-col transition-all duration-300 md:ml-64">

            @include('layouts.header')

            <main class="flex-1 overflow-y-auto p-8">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>

</html>
