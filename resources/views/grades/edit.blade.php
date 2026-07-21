<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('grades.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Edit Nilai</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('grades.update', $grade) }}" class="edu-card border border-edu-hairline space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="student_id" value="Mahasiswa" />
                    <select id="student_id" name="student_id" class="edu-input" required>
                        <option value="">Pilih Mahasiswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $grade->student_id) == $student->id ? 'selected' : '' }}>{{ $student->nama }} ({{ $student->nim }})</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('student_id')" />
                </div>
                <div>
                    <x-input-label for="course_id" value="Mata Kuliah" />
                    <select id="course_id" name="course_id" class="edu-input" required>
                        <option value="">Pilih Mata Kuliah</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $grade->course_id) == $course->id ? 'selected' : '' }}>{{ $course->kode }} - {{ $course->nama }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('course_id')" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="semester" value="Semester" />
                    <select id="semester" name="semester" class="edu-input" required>
                        <option value="">Pilih</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester', $grade->semester) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    <x-input-error :messages="$errors->get('semester')" />
                </div>
                <div>
                    <x-input-label for="tahun_akademik" value="Tahun Akademik" />
                    <x-text-input id="tahun_akademik" name="tahun_akademik" :value="old('tahun_akademik', $grade->tahun_akademik)" required />
                    <x-input-error :messages="$errors->get('tahun_akademik')" />
                </div>
            </div>

            <div>
                <x-input-label for="nilai" value="Nilai (0 - 100)" />
                <x-text-input type="number" id="nilai" name="nilai" :value="old('nilai', $grade->nilai)" required min="0" max="100" step="0.01" />
                <x-input-error :messages="$errors->get('nilai')" />
                <p class="mt-1 text-xs text-edu-muted">Grade saat ini: <span class="font-semibold text-edu-text">{{ $grade->grade }} ({{ number_format($grade->gpa, 1) }})</span></p>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('grades.index') }}" class="edu-btn-secondary">Batal</a>
                <x-primary-button>Perbarui Nilai</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
