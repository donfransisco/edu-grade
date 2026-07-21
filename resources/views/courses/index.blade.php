<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-edu-text">Mata Kuliah</h1>
            <a href="{{ route('courses.create') }}" class="edu-btn-primary text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Mata Kuliah
            </a>
        </div>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" action="{{ route('courses.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <x-search-input :value="request('search')" placeholder="Cari kode atau nama mata kuliah..." class="w-full" />
            </div>
            <select name="lecturer_id" class="edu-input w-full sm:w-48" onchange="this.form.submit()">
                <option value="">Semua Dosen</option>
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}" {{ request('lecturer_id') == $lecturer->id ? 'selected' : '' }}>{{ $lecturer->nama }}</option>
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
            @if ($courses->count())
                <div class="overflow-x-auto">
                    <table class="edu-table">
                        <thead>
                            <tr>
                                <x-table-header-sort label="Kode" field="kode" :sort-by="request('sort_by', 'created_at')" :sort-dir="request('sort_dir', 'desc')" :base-url="route('courses.index')" />
                                <x-table-header-sort label="Nama" field="nama" :sort-by="request('sort_by', 'created_at')" :sort-dir="request('sort_dir', 'desc')" :base-url="route('courses.index')" />
                                <th class="px-4 py-3">Dosen</th>
                                <th class="px-4 py-3">SKS</th>
                                <th class="px-4 py-3">Semester</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td class="px-4 py-3 font-mono text-sm text-edu-yellow">{{ $course->kode }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-text">{{ $course->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $course->lecturer?->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $course->sks }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $course->semester }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('courses.show', $course) }}" class="p-1.5 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-elevated transition-colors" title="Lihat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('courses.edit', $course) }}" class="p-1.5 rounded-lg text-edu-muted hover:text-edu-yellow hover:bg-edu-yellow/10 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <button
                                                x-data
                                                @click="$dispatch('open-modal', 'confirm-delete-course-{{ $course->id }}')"
                                                class="p-1.5 rounded-lg text-edu-muted hover:text-edu-danger hover:bg-edu-danger/10 transition-colors"
                                                title="Hapus"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <x-confirm-delete
                                    name="confirm-delete-course-{{ $course->id }}"
                                    action="{{ route('courses.destroy', $course) }}"
                                    title="Hapus Mata Kuliah"
                                    description="{{ $course->nama }} ({{ $course->kode }}) akan dihapus permanen."
                                />
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-edu-hairline">
                    <x-pagination :paginator="$courses" />
                </div>
            @else
                <x-empty-state
                    title="{{ request('search') ? 'Tidak ada data ditemukan' : 'Belum ada mata kuliah' }}"
                    description="{{ request('search') ? 'Coba kata kunci lain.' : 'Klik tombol Tambah Mata Kuliah untuk memulai.' }}"
                    :icon="request('search') ? 'search' : 'inbox'"
                />
            @endif
        </div>
    </div>
</x-app-layout>
