<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('lecturers.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Edit Dosen</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('lecturers.update', $lecturer) }}" class="edu-card border border-edu-hairline space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="nidn" value="NIDN" />
                    <x-text-input id="nidn" name="nidn" :value="old('nidn', $lecturer->nidn)" required />
                    <x-input-error :messages="$errors->get('nidn')" />
                </div>
                <div>
                    <x-input-label for="nama" value="Nama Lengkap" />
                    <x-text-input id="nama" name="nama" :value="old('nama', $lecturer->nama)" required />
                    <x-input-error :messages="$errors->get('nama')" />
                </div>
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" :value="old('email', $lecturer->email)" required />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="telepon" value="Nomor Telepon" />
                    <x-text-input id="telepon" name="telepon" :value="old('telepon', $lecturer->telepon)" />
                    <x-input-error :messages="$errors->get('telepon')" />
                </div>
                <div>
                    <x-input-label for="program_studi" value="Program Studi" />
                    <select id="program_studi" name="program_studi" class="edu-input" required>
                        <option value="">Pilih</option>
                        @foreach (\App\Models\Lecturer::programStudiOptions() as $prodi)
                            <option value="{{ $prodi }}" {{ old('program_studi', $lecturer->program_studi) === $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('program_studi')" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('lecturers.index') }}" class="edu-btn-secondary">Batal</a>
                <x-primary-button>Perbarui</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
