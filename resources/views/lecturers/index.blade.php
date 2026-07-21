<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-semibold text-edu-text">Dosen</h1>
            <a href="{{ route('lecturers.create') }}" class="edu-btn-primary text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Dosen
            </a>
        </div>
    </x-slot>

    <div class="space-y-4">
        {{-- Filters --}}
        <form method="GET" action="{{ route('lecturers.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <x-search-input :value="request('search')" placeholder="Cari NIDN, nama, email..." class="w-full" />
            </div>
            <select name="program_studi" class="edu-input w-full sm:w-48" onchange="this.form.submit()">
                <option value="">Semua Prodi</option>
                @foreach (\App\Models\Lecturer::programStudiOptions() as $prodi)
                    <option value="{{ $prodi }}" {{ request('program_studi') === $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                @endforeach
            </select>
            <button type="submit" class="edu-btn-primary text-sm whitespace-nowrap">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </form>

        {{-- Table --}}
        <div class="edu-card border border-edu-hairline overflow-hidden p-0">
            @if ($lecturers->count())
                <div class="overflow-x-auto">
                    <table class="edu-table">
                        <thead>
                            <tr>
                                <x-table-header-sort label="NIDN" field="nidn" :sort-by="request('sort_by', 'created_at')" :sort-dir="request('sort_dir', 'desc')" :base-url="route('lecturers.index')" />
                                <x-table-header-sort label="Nama" field="nama" :sort-by="request('sort_by', 'created_at')" :sort-dir="request('sort_dir', 'desc')" :base-url="route('lecturers.index')" />
                                <th class="px-4 py-3">Prodi</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Telepon</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lecturers as $lecturer)
                                <tr>
                                    <td class="px-4 py-3 font-mono text-sm text-edu-yellow">{{ $lecturer->nidn }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-edu-elevated flex items-center justify-center text-xs font-semibold text-edu-muted shrink-0">
                                                {{ strtoupper(substr($lecturer->nama, 0, 1)) }}
                                            </div>
                                            <span class="text-sm text-edu-text">{{ $lecturer->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $lecturer->program_studi }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $lecturer->email }}</td>
                                    <td class="px-4 py-3 text-sm text-edu-muted">{{ $lecturer->telepon ?: '-' }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('lecturers.show', $lecturer) }}" class="p-1.5 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-elevated transition-colors" title="Lihat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('lecturers.edit', $lecturer) }}" class="p-1.5 rounded-lg text-edu-muted hover:text-edu-yellow hover:bg-edu-yellow/10 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <button
                                                x-data
                                                @click="$dispatch('open-modal', 'confirm-delete-{{ $lecturer->id }}')"
                                                class="p-1.5 rounded-lg text-edu-muted hover:text-edu-danger hover:bg-edu-danger/10 transition-colors"
                                                title="Hapus"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <x-confirm-delete
                                    name="confirm-delete-{{ $lecturer->id }}"
                                    action="{{ route('lecturers.destroy', $lecturer) }}"
                                    title="Hapus Dosen"
                                    description="Data {{ $lecturer->nama }} ({{ $lecturer->nidn }}) akan dihapus permanen."
                                />
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-edu-hairline">
                    <x-pagination :paginator="$lecturers" />
                </div>
            @else
                <x-empty-state
                    title="{{ request('search') ? 'Tidak ada data ditemukan' : 'Belum ada data dosen' }}"
                    description="{{ request('search') ? 'Coba kata kunci lain.' : 'Klik tombol Tambah Dosen untuk memulai.' }}"
                    :icon="request('search') ? 'search' : 'inbox'"
                />
            @endif
        </div>
    </div>
</x-app-layout>
