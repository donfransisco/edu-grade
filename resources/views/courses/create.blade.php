<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('courses.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Tambah Mata Kuliah</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('courses.store') }}" class="edu-card border border-edu-hairline space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="kode" value="Kode Mata Kuliah" />
                    <x-text-input id="kode" name="kode" :value="old('kode')" required autofocus placeholder="e.g. IF101" />
                    <x-input-error :messages="$errors->get('kode')" />
                </div>
                <div>
                    <x-input-label for="nama" value="Nama Mata Kuliah" />
                    <x-text-input id="nama" name="nama" :value="old('nama')" required />
                    <x-input-error :messages="$errors->get('nama')" />
                </div>
            </div>

            <div>
                <x-input-label for="lecturer_id" value="Dosen Pengampu" />
                <select id="lecturer_id" name="lecturer_id" class="edu-input" required>
                    <option value="">Pilih Dosen</option>
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ old('lecturer_id') == $lecturer->id ? 'selected' : '' }}>{{ $lecturer->nama }} ({{ $lecturer->nidn }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('lecturer_id')" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="sks" value="SKS" />
                    <select id="sks" name="sks" class="edu-input" required>
                        <option value="">Pilih</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ old('sks') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <x-input-error :messages="$errors->get('sks')" />
                </div>
                <div>
                    <x-input-label for="semester" value="Semester" />
                    <select id="semester" name="semester" class="edu-input" required>
                        <option value="">Pilih</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <x-input-error :messages="$errors->get('semester')" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('courses.index') }}" class="edu-btn-secondary">Batal</a>
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
