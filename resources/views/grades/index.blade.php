<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-edu-text">Nilai</h1>
            <a href="{{ route('grades.create') }}" class="edu-btn-primary text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Input Nilai
            </a>
        </div>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" action="{{ route('grades.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <x-search-input :value="request('search')" placeholder="Cari NIM atau nama mahasiswa..." class="w-full" />
            </div>
            <select name="course_id" class="edu-input w-full sm:w-48" onchange="this.form.submit()">
                <option value="">Semua Mata Kuliah</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->kode }} - {{ $course->nama }}</option>
                @endforeach
            </select>
            <select name="semester" class="edu-input w-full sm:w-36" onchange="this.form.submit()">
                <option value="">Semua Semester</option>
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                @endfor
            </select>
            <button type="submit" class="edu-btn-primary text-sm whitespace-nowrap">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </form>

        <div class="edu-card border border-edu-hairline overflow-hidden p-0">
            @if ($grades->count())
                <div class="overflow-x-auto">
                    <table class="edu-table" style="table-layout: fixed; width: 100%;">
                        <colgroup>
                            <col style="width: 22%">
                            <col style="width: 28%">
                            <col style="width: 8%">
                            <col style="width: 14%">
                            <col style="width: 16%">
                            <col style="width: 12%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="px-3 py-2">Mahasiswa</th>
                                <th class="px-3 py-2">Mata Kuliah</th>
                                <x-table-header-sort label="Sem" field="semester" :sort-by="request('sort_by', 'created_at')" :sort-dir="request('sort_dir', 'desc')" :base-url="route('grades.index')" />
                                <th class="px-3 py-2">Tahun</th>
                                <x-table-header-sort label="Nilai" field="nilai" :sort-by="request('sort_by', 'created_at')" :sort-dir="request('sort_dir', 'desc')" :base-url="route('grades.index')" />
                                <th class="px-3 py-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td class="px-3 py-2">
                                        <p class="text-sm text-edu-text truncate">{{ $grade->student->nama }}</p>
                                        <p class="text-sm text-edu-muted font-mono truncate">{{ $grade->student->nim }}</p>
                                    </td>
                                    <td class="px-3 py-2 text-sm text-edu-text truncate">{{ $grade->course->kode }} - {{ $grade->course->nama }}</td>
                                    <td class="px-3 py-2 text-sm text-edu-muted text-center">{{ $grade->semester }}</td>
                                    <td class="px-3 py-2 text-sm text-edu-muted truncate">{{ $grade->tahun_akademik }}</td>
                                    <td class="px-3 py-2 text-right whitespace-nowrap">
                                        <span class="text-sm font-mono text-edu-text">{{ number_format($grade->nilai, 2) }}</span>
                                        <span class="ml-1 inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-semibold
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
                                    <td class="px-3 py-2 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('grades.edit', $grade) }}" class="p-1.5 rounded-lg text-edu-muted hover:text-edu-yellow hover:bg-edu-yellow/10 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <button
                                                x-data
                                                @click="$dispatch('open-modal', 'confirm-delete-grade-{{ $grade->id }}')"
                                                class="p-1.5 rounded-lg text-edu-muted hover:text-edu-danger hover:bg-edu-danger/10 transition-colors"
                                                title="Hapus"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <x-confirm-delete
                                    name="confirm-delete-grade-{{ $grade->id }}"
                                    action="{{ route('grades.destroy', $grade) }}"
                                    title="Hapus Nilai"
                                    description="Nilai untuk {{ $grade->student->nama }} di {{ $grade->course->kode }} akan dihapus permanen."
                                />
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-edu-hairline">
                    <x-pagination :paginator="$grades" />
                </div>
            @else
                <x-empty-state
                    title="{{ request('search') ? 'Tidak ada data ditemukan' : 'Belum ada data nilai' }}"
                    description="{{ request('search') ? 'Coba kata kunci lain.' : 'Klik tombol Input Nilai untuk memulai.' }}"
                    :icon="request('search') ? 'search' : 'inbox'"
                />
            @endif
        </div>
    </div>
</x-app-layout>
