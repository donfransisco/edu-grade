<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('lecturers.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Detail Dosen</h1>
        </div>
    </x-slot>

    <div class="max-w-3xl space-y-4">
        {{-- Profile Card --}}
        <div class="edu-card border border-edu-hairline">
            <div class="flex items-start gap-5">
                <div class="w-20 h-20 rounded-full bg-edu-elevated border border-edu-hairline flex items-center justify-center text-2xl font-bold text-edu-yellow shrink-0">
                    {{ strtoupper(substr($lecturer->nama, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-edu-text">{{ $lecturer->nama }}</h2>
                    <p class="text-sm text-edu-yellow font-mono mt-1">NIDN: {{ $lecturer->nidn }}</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="edu-badge bg-edu-elevated text-edu-muted">{{ $lecturer->program_studi }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-1 shrink-0">
                    <a href="{{ route('lecturers.edit', $lecturer) }}" class="edu-btn-secondary text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-edu-hairline">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-edu-muted uppercase tracking-wider">Email</p>
                        <p class="mt-1 text-sm text-edu-text">{{ $lecturer->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-edu-muted uppercase tracking-wider">Telepon</p>
                        <p class="mt-1 text-sm text-edu-text">{{ $lecturer->telepon ?: '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Courses --}}
        <div class="edu-card border border-edu-hairline">
            <h3 class="text-base font-semibold text-edu-text mb-4">Mata Kuliah Diampu</h3>

            @if ($lecturer->courses->count())
                <div class="overflow-x-auto">
                    <table class="edu-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="px-4 py-3">Nama Mata Kuliah</th>
                                <th class="px-4 py-3">SKS</th>
                                <th class="px-4 py-3">Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lecturer->courses as $course)
                                <tr>
                                    <td class="px-4 py-3 font-mono text-sm text-edu-yellow">{{ $course->kode }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-text">{{ $course->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $course->sks }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $course->semester }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-empty-state title="Belum ada mata kuliah" description="Mata kuliah yang diampu akan muncul di sini." />
            @endif
        </div>
    </div>
</x-app-layout>
