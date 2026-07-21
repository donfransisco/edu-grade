<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('courses.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Detail Mata Kuliah</h1>
        </div>
    </x-slot>

    <div class="max-w-3xl space-y-4">
        <div class="edu-card border border-edu-hairline">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Kode</p>
                    <p class="mt-1 text-lg font-bold font-mono text-edu-yellow">{{ $course->kode }}</p>
                    <h2 class="text-xl font-bold text-edu-text mt-2">{{ $course->nama }}</h2>
                </div>
                <a href="{{ route('courses.edit', $course) }}" class="edu-btn-secondary text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 border-t border-edu-hairline">
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Dosen Pengampu</p>
                    <p class="mt-1 text-sm text-edu-text">{{ $course->lecturer?->nama ?? '-' }}</p>
                    <p class="text-xs text-edu-muted">{{ $course->lecturer?->nidn ?? '' }}</p>
                </div>
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">SKS</p>
                    <p class="mt-1 text-sm text-edu-text">{{ $course->sks }}</p>
                </div>
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Semester</p>
                    <p class="mt-1 text-sm text-edu-text">{{ $course->semester }}</p>
                </div>
            </div>
        </div>

        <div class="edu-card border border-edu-hairline">
            <h3 class="text-base font-semibold text-edu-text mb-4">Daftar Nilai</h3>

            @if ($course->grades->count())
                <div class="overflow-x-auto">
                    <table class="edu-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-3">NIM</th>
                                <th class="px-4 py-3">Mahasiswa</th>
                                <th class="px-4 py-3">Semester</th>
                                <th class="px-4 py-3">Tahun Akademik</th>
                                <th class="px-4 py-3 text-right">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->grades as $grade)
                                <tr>
                                    <td class="px-4 py-3 font-mono text-sm text-edu-muted">{{ $grade->student->nim }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-text">{{ $grade->student->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $grade->semester }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $grade->tahun_akademik }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <span class="text-sm font-mono text-edu-text">{{ number_format($grade->nilai, 2) }}</span>
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold
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
                <x-empty-state title="Belum ada nilai" description="Data nilai untuk mata kuliah ini akan muncul di sini." />
            @endif
        </div>
    </div>
</x-app-layout>
