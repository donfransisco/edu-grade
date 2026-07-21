<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-edu-text">Dashboard</h1>
    </x-slot>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="edu-card border border-edu-hairline">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Total Mahasiswa</p>
                    <p class="mt-1 edu-stat-number text-edu-yellow">-</p>
                </div>
                <div class="w-10 h-10 bg-edu-yellow/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="edu-card border border-edu-hairline">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Total Dosen</p>
                    <p class="mt-1 edu-stat-number text-edu-text">-</p>
                </div>
                <div class="w-10 h-10 bg-edu-info/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-edu-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="edu-card border border-edu-hairline">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Mata Kuliah</p>
                    <p class="mt-1 edu-stat-number text-edu-text">-</p>
                </div>
                <div class="w-10 h-10 bg-edu-success/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-edu-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="edu-card border border-edu-hairline">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Rata-rata IPK</p>
                    <p class="mt-1 edu-stat-number text-edu-success">-</p>
                </div>
                <div class="w-10 h-10 bg-edu-danger/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-edu-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Welcome message --}}
    <div class="edu-card border border-edu-hairline">
        <h2 class="text-lg font-semibold text-edu-text mb-2">Selamat datang, {{ Auth::user()->name }}</h2>
        <p class="text-sm text-edu-muted">
            Ini adalah halaman dashboard EduGrade. Data statistik akan terisi setelah module CRUD diimplementasikan.
        </p>
    </div>
</x-app-layout>
