<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-edu-text">Laporan</h1>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="edu-btn-secondary text-sm no-print">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak
                </button>
                <a href="{{ route('reports.export', request()->query()) }}" class="edu-btn-primary text-sm no-print" target="_blank">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-4">
        {{-- Filter --}}
        <form method="GET" action="{{ route('reports.index') }}" class="edu-card border border-edu-hairline">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <x-input-label for="search" value="Cari" />
                    <x-text-input id="search" name="search" :value="request('search')" placeholder="NIM, nama, kode MK..." />
                </div>
                <div>
                    <x-input-label for="semester" value="Semester" />
                    <select id="semester" name="semester" class="edu-input" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <x-input-label for="tahun_akademik" value="Tahun Akademik" />
                    <select id="tahun_akademik" name="tahun_akademik" class="edu-input" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        @foreach ($tahunAkademiks as $ta)
                            <option value="{{ $ta }}" {{ request('tahun_akademik') == $ta ? 'selected' : '' }}>{{ $ta }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="program_studi" value="Program Studi" />
                    <select id="program_studi" name="program_studi" class="edu-input" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        @foreach ($programStudiOptions as $prodi)
                            <option value="{{ $prodi }}" {{ request('program_studi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="course_id" value="Mata Kuliah" />
                    <select id="course_id" name="course_id" class="edu-input" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->kode }} - {{ $course->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="edu-btn-primary text-sm w-full">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Filter
                    </button>
                </div>
            </div>
        </form>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="edu-card border border-edu-hairline">
                <p class="text-xs text-edu-muted uppercase tracking-wider">Rata-rata Nilai</p>
                <p class="mt-1 edu-stat-number text-edu-yellow">{{ number_format($stats['avg'], 2) }}</p>
            </div>
            <div class="edu-card border border-edu-hairline">
                <p class="text-xs text-edu-muted uppercase tracking-wider">Nilai Tertinggi</p>
                <p class="mt-1 edu-stat-number text-edu-success">{{ number_format($stats['max'], 2) }}</p>
            </div>
            <div class="edu-card border border-edu-hairline">
                <p class="text-xs text-edu-muted uppercase tracking-wider">Nilai Terendah</p>
                <p class="mt-1 edu-stat-number text-edu-danger">{{ number_format($stats['min'], 2) }}</p>
            </div>
            <div class="edu-card border border-edu-hairline">
                <p class="text-xs text-edu-muted uppercase tracking-wider">Total Data</p>
                <p class="mt-1 edu-stat-number text-edu-text">{{ number_format($stats['total']) }}</p>
            </div>
        </div>

        {{-- Grade Distribution --}}
        <div class="edu-card border border-edu-hairline">
            <h3 class="text-base font-semibold text-edu-text mb-4">Distribusi Grade</h3>
            <div class="grid grid-cols-5 gap-3">
                @php
                    $maxCount = max(max(array_values($stats['distribution'])), 1);
                    $colors = ['A' => 'bg-edu-success', 'B' => 'bg-edu-info', 'C' => 'bg-edu-yellow', 'D' => 'bg-edu-muted', 'E' => 'bg-edu-danger'];
                @endphp
                @foreach ($stats['distribution'] as $grade => $count)
                    @php
                        $pct = $stats['total'] > 0 ? round(($count / $stats['total']) * 100, 1) : 0;
                        $barH = $maxCount > 0 ? max(($count / $maxCount) * 100, 4) : 4;
                    @endphp
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-2xl font-bold text-edu-text">{{ $count }}</span>
                        <div class="w-full h-32 flex items-end justify-center">
                            <div class="w-full max-w-[3rem] {{ $colors[$grade] }} rounded-t-md transition-all" style="height: {{ $barH }}%"></div>
                        </div>
                        <span class="text-sm font-semibold text-edu-text">{{ $grade }}</span>
                        <span class="text-xs text-edu-muted">{{ $pct }}%</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Table --}}
        <div class="edu-card border border-edu-hairline overflow-hidden p-0">
            @if ($grades->count())
                <div class="overflow-x-auto">
                    <table class="edu-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-3">NIM</th>
                                <th class="px-4 py-3">Mahasiswa</th>
                                <th class="px-4 py-3">Mata Kuliah</th>
                                <th class="px-4 py-3">Semester</th>
                                <th class="px-4 py-3">Tahun Akademik</th>
                                <th class="px-4 py-3 text-right">Nilai</th>
                                <th class="px-4 py-3 text-right">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td class="px-4 py-3 font-mono text-sm text-edu-muted">{{ $grade->student?->nim ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-text">{{ $grade->student?->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-text">{{ $grade->course?->kode ?? '-' }} - {{ $grade->course?->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $grade->semester }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $grade->tahun_akademik }}</td>
                                    <td class="px-4 py-3 text-right text-sm font-mono text-edu-text">{{ number_format($grade->nilai, 2) }}</td>
                                    <td class="px-4 py-3 text-right">
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

                <div class="px-6 py-4 border-t border-edu-hairline">
                    <x-pagination :paginator="$grades" />
                </div>
            @else
                <x-empty-state
                    title="Tidak ada data"
                    description="Coba ubah filter atau kata kunci pencarian."
                    icon="search"
                />
            @endif
        </div>
    </div>
</x-app-layout>
