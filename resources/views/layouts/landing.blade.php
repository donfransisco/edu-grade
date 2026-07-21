<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="EduGrade - Sistem Pengelolaan Nilai Mahasiswa Terintegrasi">

        <title>{{ config('app.name', 'EduGrade') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-edu-dark text-edu-text antialiased">
        {{-- Navbar --}}
        <nav x-data="{ mobileOpen: false, scrolled: false }"
             x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
             :class="scrolled ? 'bg-edu-dark/90 backdrop-blur-xl border-b border-edu-hairline' : 'bg-transparent'"
             class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    {{-- Logo --}}
                    <a href="/" class="flex items-center gap-2.5 shrink-0">
                        <x-application-logo class="h-8 w-auto" />
                    </a>

                    {{-- Desktop nav --}}
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#features" class="text-sm text-edu-muted hover:text-edu-text transition-colors">Features</a>
                        <a href="#workflow" class="text-sm text-edu-muted hover:text-edu-text transition-colors">Workflow</a>
                        <a href="#testimonials" class="text-sm text-edu-muted hover:text-edu-text transition-colors">Testimonials</a>
                        <a href="#faq" class="text-sm text-edu-muted hover:text-edu-text transition-colors">FAQ</a>
                    </div>

                    {{-- Desktop CTA --}}
                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="edu-btn-primary text-sm">
                                {{ __('Dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-edu-muted hover:text-edu-text transition-colors">
                                {{ __('Log in') }}
                            </a>
                            <a href="{{ route('register') }}" class="edu-btn-primary text-sm">
                                {{ __('Get started') }}
                            </a>
                        @endauth
                    </div>

                    {{-- Mobile hamburger --}}
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                        <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile menu --}}
            <div x-show="mobileOpen" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden bg-edu-card border-b border-edu-hairline">
                <div class="px-4 py-4 space-y-2">
                    <a href="#features" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-edu-muted hover:bg-edu-elevated hover:text-edu-text transition-colors">Features</a>
                    <a href="#workflow" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-edu-muted hover:bg-edu-elevated hover:text-edu-text transition-colors">Workflow</a>
                    <a href="#testimonials" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-edu-muted hover:bg-edu-elevated hover:text-edu-text transition-colors">Testimonials</a>
                    <a href="#faq" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-edu-muted hover:bg-edu-elevated hover:text-edu-text transition-colors">FAQ</a>
                    <div class="pt-2 border-t border-edu-hairline flex flex-col gap-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="edu-btn-primary text-sm text-center">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-sm text-edu-muted hover:bg-edu-elevated hover:text-edu-text transition-colors">Log in</a>
                            <a href="{{ route('register') }}" class="edu-btn-primary text-sm text-center">Get started</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{-- Main content --}}
        <main>
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="border-t border-edu-hairline bg-edu-card/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    {{-- Brand --}}
                    <div class="md:col-span-2">
                        <a href="/" class="inline-flex items-center gap-2.5 mb-4">
                            <x-application-logo class="h-8 w-auto" />
                        </a>
                        <p class="text-sm text-edu-muted max-w-sm leading-relaxed">
                            Sistem pengelolaan nilai mahasiswa terintegrasi untuk institusi pendidikan. Kelola data akademik dengan mudah dan efisien.
                        </p>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h4 class="text-sm font-semibold text-edu-text mb-4">Platform</h4>
                        <ul class="space-y-2.5">
                            <li><a href="#features" class="text-sm text-edu-muted hover:text-edu-text transition-colors">Features</a></li>
                            <li><a href="#workflow" class="text-sm text-edu-muted hover:text-edu-text transition-colors">Workflow</a></li>
                            <li><a href="{{ route('login') }}" class="text-sm text-edu-muted hover:text-edu-text transition-colors">Login</a></li>
                        </ul>
                    </div>

                    {{-- Contact --}}
                    <div>
                        <h4 class="text-sm font-semibold text-edu-text mb-4">Contact</h4>
                        <ul class="space-y-2.5">
                            <li class="text-sm text-edu-muted">info@edugrade.ac.id</li>
                            <li class="text-sm text-edu-muted">+62 21 5555 0123</li>
                            <li class="text-sm text-edu-muted">Jakarta, Indonesia</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-edu-hairline flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-edu-muted">&copy; {{ date('Y') }} EduGrade. All rights reserved.</p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="text-edu-muted hover:text-edu-text transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-edu-muted hover:text-edu-text transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
