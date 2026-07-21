<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('transcripts.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Transkrip Nilai</h1>
        </div>
    </x-slot>

    <div class="space-y-4">
        <div class="edu-card border border-edu-hairline">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div>
                    <p class="text-xs text-edu-muted uppercase tracking-wider">Biodata Mahasiswa</p>
                    <h2 class="mt-1 text-xl font-bold text-edu-text">{{ $student->nama }}</h2>
                    <div class="mt-2 grid grid-cols-2 sm:grid-cols-4 gap-x-6 gap-y-2 text-sm">
                        <div>
                            <span class="text-edu-muted">NIM</span>
                            <p class="font-mono text-edu-text">{{ $student->nim }}</p>
                        </div>
                        <div>
                            <span class="text-edu-muted">Program Studi</span>
                            <p class="text-edu-text">{{ $student->program_studi }}</p>
                        </div>
                        <div>
                            <span class="text-edu-muted">Angkatan</span>
                            <p class="text-edu-text">{{ $student->angkatan }}</p>
                        </div>
                        <div>
                            <span class="text-edu-muted">Email</span>
                            <p class="text-edu-text">{{ $student->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-right shrink-0">
                    <p class="text-xs text-edu-muted uppercase tracking-wider">IPK Kumulatif</p>
                    <p class="mt-1 text-3xl font-bold text-edu-yellow">{{ number_format($ipk, 2) }}</p>
                    <p class="text-xs text-edu-muted">Total {{ $totalSks }} SKS</p>
                </div>
            </div>
        </div>

        @if ($semesterSummaries->count())
            @foreach ($semesterSummaries as $sem)
                <div class="edu-card border border-edu-hairline">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-semibold text-edu-text">Semester {{ $sem['semester'] }}</h3>
                        <div class="flex items-center gap-4 text-sm">
                            <span class="text-edu-muted">{{ $sem['grade_count'] }} MK</span>
                            <span class="text-edu-muted">{{ $sem['total_sks'] }} SKS</span>
                            <span class="font-semibold text-edu-yellow">IP: {{ number_format($sem['ip_semester'], 2) }}</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="edu-table">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3">Kode</th>
                                    <th class="px-4 py-3">Mata Kuliah</th>
                                    <th class="px-4 py-3">SKS</th>
                                    <th class="px-4 py-3">Nilai</th>
                                    <th class="px-4 py-3">Grade</th>
                                    <th class="px-4 py-3">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sem['grades'] as $grade)
                                    <tr>
                                        <td class="px-4 py-3 font-mono text-sm text-edu-yellow">{{ $grade->course->kode }}</td>
                                        <td class="px-4 py-3 text-sm text-edu-text">{{ $grade->course->nama }}</td>
                                        <td class="px-4 py-3 text-sm text-edu-muted">{{ $grade->course->sks }}</td>
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
                                        <td class="px-4 py-3 text-sm text-edu-muted">{{ number_format($grade->gpa, 1) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @else
            <x-empty-state
                title="Belum ada nilai"
                description="Data nilai untuk mahasiswa ini akan muncul di sini."
            />
        @endif
    </div>
</x-app-layout>
