<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('students.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Tambah Mahasiswa</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data" class="edu-card border border-edu-hairline space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="nim" value="NIM" />
                    <x-text-input id="nim" name="nim" :value="old('nim')" required autofocus />
                    <x-input-error :messages="$errors->get('nim')" />
                </div>
                <div>
                    <x-input-label for="nama" value="Nama Lengkap" />
                    <x-text-input id="nama" name="nama" :value="old('nama')" required />
                    <x-input-error :messages="$errors->get('nama')" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                    <select id="jenis_kelamin" name="jenis_kelamin" class="edu-input" required>
                        <option value="">Pilih</option>
                        <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis_kelamin')" />
                </div>
                <div>
                    <x-input-label for="angkatan" value="Angkatan" />
                    <select id="angkatan" name="angkatan" class="edu-input" required>
                        <option value="">Pilih</option>
                        @for ($year = date('Y'); $year >= 2018; $year--)
                            <option value="{{ $year }}" {{ old('angkatan') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                    <x-input-error :messages="$errors->get('angkatan')" />
                </div>
            </div>

            <div>
                <x-input-label for="program_studi" value="Program Studi" />
                <select id="program_studi" name="program_studi" class="edu-input" required>
                    <option value="">Pilih</option>
                    @foreach (\App\Models\Student::programStudiOptions() as $prodi)
                        <option value="{{ $prodi }}" {{ old('program_studi') === $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('program_studi')" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="telepon" value="Nomor Telepon" />
                    <x-text-input id="telepon" name="telepon" :value="old('telepon')" />
                    <x-input-error :messages="$errors->get('telepon')" />
                </div>
                <div>
                    <x-input-label for="foto" value="Foto (opsional)" />
                    <input type="file" id="foto" name="foto" accept="image/*" class="edu-input" />
                    <x-input-error :messages="$errors->get('foto')" />
                </div>
            </div>

            <div>
                <x-input-label for="alamat" value="Alamat" />
                <textarea id="alamat" name="alamat" rows="3" class="edu-input">{{ old('alamat') }}</textarea>
                <x-input-error :messages="$errors->get('alamat')" />
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('students.index') }}" class="edu-btn-secondary">Batal</a>
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
