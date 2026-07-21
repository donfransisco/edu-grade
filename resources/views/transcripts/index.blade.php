<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-edu-text">Transkrip Nilai</h1>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" action="{{ route('transcripts.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <x-search-input :value="request('search')" placeholder="Cari NIM atau nama mahasiswa..." class="w-full" />
            </div>
            <select name="program_studi" class="edu-input w-full sm:w-48" onchange="this.form.submit()">
                <option value="">Semua Program Studi</option>
                @foreach (\App\Models\Student::programStudiOptions() as $prodi)
                    <option value="{{ $prodi }}" {{ request('program_studi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                @endforeach
            </select>
            <button type="submit" class="edu-btn-primary text-sm whitespace-nowrap">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </form>

        <div class="edu-card border border-edu-hairline overflow-hidden p-0">
            @if ($students->count())
                <div class="overflow-x-auto">
                    <table class="edu-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-3">NIM</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Program Studi</th>
                                <th class="px-4 py-3">Angkatan</th>
                                <th class="px-4 py-3">Total Nilai</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                @php
                                    $totalSks = $student->grades->sum('course.sks');
                                    $totalWeighted = $student->grades->sum(fn ($g) => $g->gpa * $g->course->sks);
                                    $ipk = $totalSks > 0 ? round($totalWeighted / $totalSks, 2) : '-';
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 font-mono text-sm text-edu-muted">{{ $student->nim }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-text">{{ $student->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $student->program_studi }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $student->angkatan }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $student->grades->count() }} data</td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('transcripts.show', $student) }}" class="edu-btn-secondary text-xs">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            Lihat Transkrip
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-edu-hairline">
                    <x-pagination :paginator="$students" />
                </div>
            @else
                <x-empty-state
                    title="{{ request('search') ? 'Tidak ada data ditemukan' : 'Belum ada data mahasiswa' }}"
                    description="{{ request('search') ? 'Coba kata kunci lain.' : 'Data mahasiswa akan muncul di sini.' }}"
                    :icon="request('search') ? 'search' : 'inbox'"
                />
            @endif
        </div>
    </div>
</x-app-layout>
