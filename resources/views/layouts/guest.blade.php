<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduGrade') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-edu-dark text-edu-text antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
            {{-- Logo --}}
            <div class="mb-8">
                <a href="/" class="flex items-center gap-2.5">
                    <x-application-logo class="h-10 w-auto" />
                </a>
            </div>

            {{-- Card --}}
            <div class="w-full max-w-md bg-edu-card border border-edu-hairline rounded-xl shadow-2xl p-8">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            <p class="mt-8 text-xs text-edu-muted">
                &copy; {{ date('Y') }} EduGrade. {{ __('All rights reserved.') }}
            </p>
        </div>
    </body>
</html>
