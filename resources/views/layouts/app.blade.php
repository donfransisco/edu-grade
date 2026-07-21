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
        <div class="min-h-screen flex" x-data="{ sidebarOpen: false, sidebarExpanded: true }">
            {{-- Mobile overlay --}}
            <div
                x-show="sidebarOpen"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false"
                class="fixed inset-0 z-40 bg-black/60 lg:hidden"
            ></div>

            {{-- Sidebar --}}
            @include('layouts.navigation')

            {{-- Main content --}}
            <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
                {{-- Top bar --}}
                <header class="sticky top-0 z-30 bg-edu-dark/80 backdrop-blur-xl border-b border-edu-hairline">
                    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                        {{-- Mobile hamburger --}}
                        <button
                            @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        {{-- Page title --}}
                        <div class="hidden lg:block">
                            @isset($header)
                                {{ $header }}
                            @endisset
                        </div>

                        {{-- Right side --}}
                        <div class="flex items-center gap-3">
                            {{-- User dropdown --}}
                            <div x-data="{ open: false }" class="relative">
                                <button
                                    @click="open = !open"
                                    class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors"
                                >
                                    <div class="w-8 h-8 rounded-full bg-edu-yellow/20 flex items-center justify-center text-edu-yellow text-sm font-semibold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-48 bg-edu-card border border-edu-hairline rounded-xl shadow-xl overflow-hidden z-50"
                                >
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-edu-muted hover:bg-edu-elevated hover:text-edu-text transition-colors">
                                        {{ __('Profile') }}
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-edu-danger hover:bg-edu-elevated transition-colors">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                {{-- Page content --}}
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    @isset($breadcrumb)
                        <div class="mb-6">
                            {{ $breadcrumb }}
                        </div>
                    @endisset

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-edu-success/10 border border-edu-success/20 rounded-xl text-edu-success text-sm flex items-center gap-2">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-edu-danger/10 border border-edu-danger/20 rounded-xl text-edu-danger text-sm flex items-center gap-2">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
