{{-- Sidebar Navigation --}}
<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-edu-card border-r border-edu-hairline flex flex-col transition-transform duration-300 lg:translate-x-0"
>
    {{-- Logo --}}
    <div class="flex items-center h-16 px-5 border-b border-edu-hairline shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <x-application-logo class="h-8 w-auto" />
        </a>
    </div>

    {{-- Nav links --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'edu-sidebar-link-active' : 'edu-sidebar-link' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            {{ __('Dashboard') }}
        </a>

        {{-- Master Data --}}
        <div class="pt-4 pb-1">
            <p class="px-3 text-xs font-semibold text-edu-muted uppercase tracking-wider">{{ __('Master Data') }}</p>
        </div>

        <a href="{{ route('students.index') }}"
           class="{{ request()->routeIs('students.*') ? 'edu-sidebar-link-active' : 'edu-sidebar-link' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            {{ __('Mahasiswa') }}
        </a>

        <a href="{{ route('lecturers.index') }}"
           class="{{ request()->routeIs('lecturers.*') ? 'edu-sidebar-link-active' : 'edu-sidebar-link' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            {{ __('Dosen') }}
        </a>

        <a href="{{ route('courses.index') }}"
           class="{{ request()->routeIs('courses.*') ? 'edu-sidebar-link-active' : 'edu-sidebar-link' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            {{ __('Mata Kuliah') }}
        </a>

        {{-- Academic --}}
        <div class="pt-4 pb-1">
            <p class="px-3 text-xs font-semibold text-edu-muted uppercase tracking-wider">{{ __('Akademik') }}</p>
        </div>

        <a href="{{ route('grades.index') }}"
           class="{{ request()->routeIs('grades.*') ? 'edu-sidebar-link-active' : 'edu-sidebar-link' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            {{ __('Nilai') }}
        </a>

        <a href="{{ route('transcripts.index') }}"
           class="{{ request()->routeIs('transcripts.*') ? 'edu-sidebar-link-active' : 'edu-sidebar-link' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            {{ __('Transkrip') }}
        </a>

        <a href="{{ route('reports.index') }}"
           class="{{ request()->routeIs('reports.*') ? 'edu-sidebar-link-active' : 'edu-sidebar-link' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            {{ __('Laporan') }}
        </a>
    </nav>

    {{-- Bottom --}}
    <div class="px-3 py-4 border-t border-edu-hairline shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="edu-sidebar-link w-full text-edu-danger/80 hover:text-edu-danger hover:bg-edu-danger/10">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</aside>
