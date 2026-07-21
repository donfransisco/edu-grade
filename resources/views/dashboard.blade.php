<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-edu-text">Dashboard</h1>
    </x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('students.index') }}" class="edu-card border border-edu-hairline hover:border-edu-yellow/30 transition-colors group cursor-pointer">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-edu-muted uppercase tracking-wider">Mahasiswa</p>
                        <p class="mt-1 edu-stat-number text-edu-yellow">{{ number_format($stats['students']) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-edu-yellow/10 rounded-xl flex items-center justify-center group-hover:bg-edu-yellow/20 transition-colors">
                        <svg class="w-5 h-5 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('lecturers.index') }}" class="edu-card border border-edu-hairline hover:border-edu-info/30 transition-colors group cursor-pointer">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-edu-muted uppercase tracking-wider">Dosen</p>
                        <p class="mt-1 edu-stat-number text-edu-info">{{ number_format($stats['lecturers']) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-edu-info/10 rounded-xl flex items-center justify-center group-hover:bg-edu-info/20 transition-colors">
                        <svg class="w-5 h-5 text-edu-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('courses.index') }}" class="edu-card border border-edu-hairline hover:border-edu-success/30 transition-colors group cursor-pointer">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-edu-muted uppercase tracking-wider">Mata Kuliah</p>
                        <p class="mt-1 edu-stat-number text-edu-success">{{ number_format($stats['courses']) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-edu-success/10 rounded-xl flex items-center justify-center group-hover:bg-edu-success/20 transition-colors">
                        <svg class="w-5 h-5 text-edu-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('grades.index') }}" class="edu-card border border-edu-hairline hover:border-edu-danger/30 transition-colors group cursor-pointer">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-edu-muted uppercase tracking-wider">Rata-rata IPK</p>
                        <p class="mt-1 edu-stat-number text-edu-danger">{{ number_format($stats['avgGpa'], 2) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-edu-danger/10 rounded-xl flex items-center justify-center group-hover:bg-edu-danger/20 transition-colors">
                        <svg class="w-5 h-5 text-edu-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <div class="edu-card border border-edu-hairline">
            <h2 class="text-base font-semibold text-edu-text mb-4">Nilai Terakhir</h2>

            @if ($stats['recentGrades']->count())
                <div class="overflow-x-auto">
                    <table class="edu-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-3">Mahasiswa</th>
                                <th class="px-4 py-3">Mata Kuliah</th>
                                <th class="px-4 py-3">Nilai</th>
                                <th class="px-4 py-3">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats['recentGrades'] as $grade)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-edu-text">{{ $grade->student->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $grade->course->kode }} - {{ $grade->course->nama }}</td>
                                    <td class="px-4 py-3 text-sm font-mono text-edu-text">{{ number_format($grade->nilai, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold
                                            {{ match($grade->grade) {
                                                'A' => 'bg-edu-success/15 text-edu-success',
                                                'B' => 'bg-edu-info/15 text-edu-info',
                                                'C' => 'bg-edu-yellow/15 text-edu-yellow',
                                                'D' => 'bg-edu-yellow/10 text-edu-muted',
                                                default => 'bg-edu-danger/15 text-edu-danger',
                                            } }}">
                                            {{ $grade->grade }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-empty-state title="Belum ada data nilai" description="Data nilai terakhir akan muncul di sini." icon="inbox" />
            @endif
        </div>
    </div>
</x-app-layout>
