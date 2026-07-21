<?php

use Illuminate\Support\Facades\Storage;

?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('students.index') }}" class="p-2 rounded-lg text-edu-muted hover:text-edu-text hover:bg-edu-card transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-lg font-semibold text-edu-text">Detail Mahasiswa</h1>
        </div>
    </x-slot>

    <div class="max-w-3xl space-y-4">
        {{-- Profile Card --}}
        <div class="edu-card border border-edu-hairline">
            <div class="flex items-start gap-5">
                <div class="w-20 h-20 rounded-full bg-edu-elevated border border-edu-hairline flex items-center justify-center text-2xl font-bold text-edu-yellow shrink-0 overflow-hidden">
                    @if ($student->foto)
                        <img src="{{ Storage::url($student->foto) }}" alt="{{ $student->nama }}" class="w-full h-full object-cover" />
                    @else
                        {{ strtoupper(substr($student->nama, 0, 1)) }}
                    @endif
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-edu-text">{{ $student->nama }}</h2>
                    <p class="text-sm text-edu-yellow font-mono mt-1">NIM: {{ $student->nim }}</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="edu-badge bg-edu-elevated text-edu-muted">{{ $student->program_studi }}</span>
                        <span class="edu-badge bg-edu-elevated text-edu-muted">Angkatan {{ $student->angkatan }}</span>
                        <span class="edu-badge bg-edu-elevated text-edu-muted">{{ $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-1 shrink-0">
                    <a href="{{ route('students.edit', $student) }}" class="edu-btn-secondary text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6 border-t border-edu-hairline">
                <div>
                    <p class="text-sm text-edu-muted uppercase tracking-wider">Email</p>
                    <p class="mt-1 text-sm text-edu-text">{{ $student->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-edu-muted uppercase tracking-wider">Telepon</p>
                    <p class="mt-1 text-sm text-edu-text">{{ $student->telepon ?: '-' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-sm text-edu-muted uppercase tracking-wider">Alamat</p>
                    <p class="mt-1 text-sm text-edu-text">{{ $student->alamat ?: '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Grades --}}
        <div class="edu-card border border-edu-hairline">
            <h3 class="text-base font-semibold text-edu-text mb-4">Daftar Nilai</h3>

            @if ($student->grades->count())
                <div class="overflow-x-auto">
                    <table class="edu-table" style="table-layout: fixed; width: 100%;">
                        <colgroup>
                            <col style="width: 40%">
                            <col style="width: 8%">
                            <col style="width: 12%">
                            <col style="width: 20%">
                            <col style="width: 20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="px-3 py-2">Mata Kuliah</th>
                                <th class="px-3 py-2 text-center">SKS</th>
                                <th class="px-3 py-2 text-center">Sem</th>
                                <th class="px-3 py-2">Tahun</th>
                                <th class="px-3 py-2 text-right">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->grades as $grade)
                                <tr>
                                    <td class="px-3 py-2">
                                        <p class="text-sm text-edu-text truncate">{{ $grade->course->nama }}</p>
                                        <p class="text-sm text-edu-muted font-mono truncate">{{ $grade->course->kode }}</p>
                                    </td>
                                    <td class="px-3 py-2 text-sm text-edu-muted text-center">{{ $grade->course->sks }}</td>
                                    <td class="px-3 py-2 text-sm text-edu-muted text-center">{{ $grade->semester }}</td>
                                    <td class="px-3 py-2 text-sm text-edu-muted truncate">{{ $grade->tahun_akademik }}</td>
                                    <td class="px-3 py-2 text-right whitespace-nowrap">
                                        <span class="text-sm font-mono text-edu-text">{{ number_format($grade->nilai, 2) }}</span>
                                        <span class="ml-1.5 inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-semibold
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
            @else
                <x-empty-state title="Belum ada nilai" description="Data nilai akan muncul di sini setelah ditambahkan." />
            @endif
        </div>
    </div>
</x-app-layout>
