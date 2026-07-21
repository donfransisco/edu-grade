<x-layouts.landing>

    {{-- Hero Section - Asymmetric Split --}}
    <section class="relative min-h-screen flex items-center pt-16 overflow-hidden">
        {{-- Background pattern --}}
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-1/4 -left-32 w-96 h-96 bg-edu-yellow/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-0 w-80 h-80 bg-edu-yellow/3 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-0">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                {{-- Left: Content --}}
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-edu-yellow/10 border border-edu-yellow/20 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 bg-edu-yellow rounded-full"></span>
                        <span class="text-xs font-medium text-edu-yellow">Academic Management System</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-edu-text leading-[1.1] tracking-tight">
                        Kelola Nilai Mahasiswa
                        <span class="text-edu-yellow"> Lebih Mudah</span>
                    </h1>

                    <p class="mt-6 text-lg text-edu-muted leading-relaxed max-w-lg">
                        Sistem terintegrasi untuk mengelola data mahasiswa, dosen, mata kuliah, dan nilai akademik. Perhitungan otomatis, laporan real-time.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="edu-btn-primary px-8 py-3">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="edu-btn-primary px-8 py-3">
                                Mulai Gratis
                            </a>
                            <a href="{{ route('login') }}" class="edu-btn-secondary px-8 py-3">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- Right: Visual - Stats Preview Card --}}
                <div class="relative hidden lg:block">
                    <div class="edu-card border border-edu-hairline shadow-2xl shadow-black/30">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-3 h-3 rounded-full bg-edu-danger"></div>
                            <div class="w-3 h-3 rounded-full bg-edu-yellow"></div>
                            <div class="w-3 h-3 rounded-full bg-edu-success"></div>
                            <span class="ml-2 text-xs text-edu-muted">Dashboard Preview</span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-edu-elevated rounded-lg p-4">
                                <p class="text-xs text-edu-muted mb-1">Total Mahasiswa</p>
                                <p class="edu-stat-number text-edu-yellow">2.408</p>
                            </div>
                            <div class="bg-edu-elevated rounded-lg p-4">
                                <p class="text-xs text-edu-muted mb-1">Mata Kuliah</p>
                                <p class="edu-stat-number text-edu-text">156</p>
                            </div>
                            <div class="bg-edu-elevated rounded-lg p-4">
                                <p class="text-xs text-edu-muted mb-1">Rata-rata IPK</p>
                                <p class="edu-stat-number text-edu-success">3.52</p>
                            </div>
                            <div class="bg-edu-elevated rounded-lg p-4">
                                <p class="text-xs text-edu-muted mb-1">Dosen Aktif</p>
                                <p class="edu-stat-number text-edu-text">87</p>
                            </div>
                        </div>

                        <div class="mt-4 bg-edu-elevated rounded-lg p-4">
                            <p class="text-xs text-edu-muted mb-3">Distribusi Nilai</p>
                            <div class="flex items-end gap-1.5 h-20">
                                <div class="flex-1 bg-edu-success/80 rounded-t" style="height: 35%"></div>
                                <div class="flex-1 bg-edu-success rounded-t" style="height: 55%"></div>
                                <div class="flex-1 bg-edu-yellow rounded-t" style="height: 70%"></div>
                                <div class="flex-1 bg-edu-yellow rounded-t" style="height: 45%"></div>
                                <div class="flex-1 bg-edu-danger rounded-t" style="height: 20%"></div>
                            </div>
                            <div class="flex gap-1.5 mt-1.5 text-[10px] text-edu-muted">
                                <div class="flex-1 text-center">A</div>
                                <div class="flex-1 text-center">B</div>
                                <div class="flex-1 text-center">C</div>
                                <div class="flex-1 text-center">D</div>
                                <div class="flex-1 text-center">E</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section - Bento Layout --}}
    <section id="features" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-edu-text tracking-tight">
                    Fitur Unggulan
                </h2>
                <p class="mt-4 text-edu-muted text-lg">
                    Kelola seluruh aspek akademik dari satu tempat. Dari data mahasiswa hingga laporan transkrip.
                </p>
            </div>

            {{-- Bento grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Large feature card --}}
                <div class="md:col-span-2 bg-edu-card border border-edu-hairline rounded-xl p-8 hover:border-edu-yellow/30 transition-colors duration-300">
                    <div class="w-12 h-12 bg-edu-yellow/10 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-edu-text mb-2">Student Management</h3>
                    <p class="text-edu-muted leading-relaxed">
                        Kelola data mahasiswa lengkap: NIM, nama, program studi, angkatan, kontak, dan foto. pencarian dan filter built-in.
                    </p>
                </div>

                <div class="bg-edu-card border border-edu-hairline rounded-xl p-8 hover:border-edu-yellow/30 transition-colors duration-300">
                    <div class="w-12 h-12 bg-edu-yellow/10 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-edu-text mb-2">Lecturer Management</h3>
                    <p class="text-edu-muted leading-relaxed">
                        Database dosen dengan NIDN, informasi kontak, dan program studi yang terhubung ke mata kuliah.
                    </p>
                </div>

                <div class="bg-edu-card border border-edu-hairline rounded-xl p-8 hover:border-edu-yellow/30 transition-colors duration-300">
                    <div class="w-12 h-12 bg-edu-yellow/10 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-edu-text mb-2">Grade Management</h3>
                    <p class="text-edu-muted leading-relaxed">
                        Input nilai dengan perhitungan otomatis. Nilai huruf dihitung berdasarkan standar institusi.
                    </p>
                </div>

                <div class="bg-edu-card border border-edu-hairline rounded-xl p-8 hover:border-edu-yellow/30 transition-colors duration-300">
                    <div class="w-12 h-12 bg-edu-yellow/10 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-edu-text mb-2">Course Management</h3>
                    <p class="text-edu-muted leading-relaxed">
                        Kelola mata kuliah beserta SKS, semester, dan dosen pengampu. Terintegrasi dengan sistem nilai.
                    </p>
                </div>

                <div class="md:col-span-2 bg-gradient-to-br from-edu-yellow/10 to-edu-card border border-edu-yellow/20 rounded-xl p-8">
                    <div class="w-12 h-12 bg-edu-yellow/20 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-edu-text mb-2">Dashboard Analytics</h3>
                    <p class="text-edu-muted leading-relaxed max-w-lg">
                        Visualisasi data real-time: distribusi nilai, rata-rata IPK per semester, tren akademik. Filter berdasarkan program studi dan semester.
                    </p>
                </div>

                <div class="bg-edu-card border border-edu-hairline rounded-xl p-8 hover:border-edu-yellow/30 transition-colors duration-300">
                    <div class="w-12 h-12 bg-edu-yellow/10 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-edu-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-edu-text mb-2">Academic Reports</h3>
                    <p class="text-edu-muted leading-relaxed">
                        Transkrip nilai otomatis, export CSV, cetak laporan. Filter berdasarkan semester dan tahun akademik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflow Section --}}
    <section id="workflow" class="py-24 bg-edu-card/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-edu-text tracking-tight">
                    Alur Kerja
                </h2>
                <p class="mt-4 text-edu-muted text-lg">
                    Proses sederhana dari input data hingga laporan akademik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                @php
                    $steps = [
                        ['num' => '01', 'title' => 'Input Mahasiswa', 'desc' => 'Daftarkan data mahasiswa baru'],
                        ['num' => '02', 'title' => 'Input Dosen', 'desc' => 'Kelola data dosen pengampu'],
                        ['num' => '03', 'title' => 'Input Mata Kuliah', 'desc' => 'Atur jadwal dan SKS'],
                        ['num' => '04', 'title' => 'Input Nilai', 'desc' => 'Masukkan nilai per mata kuliah'],
                        ['num' => '05', 'title' => 'Laporan', 'desc' => 'Transkrip & laporan otomatis'],
                    ];
                @endphp

                @foreach ($steps as $index => $step)
                    <div class="relative group">
                        <div class="edu-card border border-edu-hairline group-hover:border-edu-yellow/30 transition-colors duration-300 text-center">
                            <span class="text-4xl font-bold font-mono text-edu-yellow/20 group-hover:text-edu-yellow/40 transition-colors">{{ $step['num'] }}</span>
                            <h3 class="mt-3 text-base font-semibold text-edu-text">{{ $step['title'] }}</h3>
                            <p class="mt-1 text-sm text-edu-muted">{{ $step['desc'] }}</p>
                        </div>

                        @if (!$loop->last)
                            <div class="hidden md:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-edu-muted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Statistics Section --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="edu-card border border-edu-hairline">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <p class="edu-stat-number text-edu-yellow">2.408</p>
                        <p class="mt-2 text-sm text-edu-muted">Total Mahasiswa</p>
                    </div>
                    <div class="text-center">
                        <p class="edu-stat-number text-edu-text">87</p>
                        <p class="mt-2 text-sm text-edu-muted">Total Dosen</p>
                    </div>
                    <div class="text-center">
                        <p class="edu-stat-number text-edu-text">156</p>
                        <p class="mt-2 text-sm text-edu-muted">Mata Kuliah</p>
                    </div>
                    <div class="text-center">
                        <p class="edu-stat-number text-edu-success">3.52</p>
                        <p class="mt-2 text-sm text-edu-muted">Rata-rata IPK</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section id="testimonials" class="py-24 bg-edu-card/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-edu-text tracking-tight">
                    Dipercaya Institusi Pendidikan
                </h2>
                <p class="mt-4 text-edu-muted text-lg">
                    Bagaimana EduGrade membantu mengelola data akademik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $testimonials = [
                        ['name' => 'Dr. Siti Rahmawati', 'role' => 'Kaprodi Informatika', 'quote' => 'EduGrade sangat membantu dalam mengelola nilai mahasiswa. Perhitungan IPK otomatis menghemat banyak waktu kami.'],
                        ['name' => 'Prof. Budi Santoso', 'role' => 'Dekan Fakultas Teknik', 'quote' => 'Dashboard analytics memberikan insight yang jelas tentang performa akademik mahasiswa kami secara real-time.'],
                        ['name' => 'Rina Wulandari, M.Kom', 'role' => 'Sekretaris Prodi Sistem Informasi', 'quote' => 'Export CSV dan fitur cetak transkrip sangat memudahkan proses administrasi di akhir semester.'],
                    ];
                @endphp

                @foreach ($testimonials as $testimonial)
                    <div class="edu-card border border-edu-hairline">
                        <div class="flex items-center gap-1 mb-4">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 text-edu-yellow" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm text-edu-text leading-relaxed">"{{ $testimonial['quote'] }}"</p>
                        <div class="mt-4 pt-4 border-t border-edu-hairline">
                            <p class="text-sm font-medium text-edu-text">{{ $testimonial['name'] }}</p>
                            <p class="text-xs text-edu-muted">{{ $testimonial['role'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section id="faq" class="py-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-edu-text tracking-tight">
                    Pertanyaan Umum
                </h2>
            </div>

            <div class="space-y-3" x-data="{ activeFaq: null }">
                @php
                    $faqs = [
                        ['q' => 'Bagaimana cara menghitung nilai huruf?', 'a' => 'Nilai huruf dihitung otomatis berdasarkan nilai angka: A (85-100), B (70-84), C (60-69), D (50-59), E (di bawah 50). Sistem akan otomatis mengkonversi saat Anda memasukkan nilai angka.'],
                        ['q' => 'Bagaimana cara melihat transkrip nilai mahasiswa?', 'a' => 'Pilih menu Transkrip di sidebar, kemudian pilih mahasiswa yang ingin dilihat transkripnya. Sistem akan menampilkan seluruh nilai, IP semester, dan IPK secara otomatis.'],
                        ['q' => 'Apakah bisa export data ke CSV?', 'a' => 'Ya, halaman Laporan menyediakan fitur Export CSV dan Print. Anda bisa filter berdasarkan semester, tahun akademik, program studi, atau mata kuliah sebelum export.'],
                        ['q' => 'Bagaimana cara menambahkan foto mahasiswa?', 'a' => 'Saat membuat atau mengedit data mahasiswa, ada field upload foto. Format yang didukung: JPG, PNG, dengan ukuran maksimal 2MB. Foto akan disimpan secara aman di server.'],
                        ['q' => 'Siapa yang bisa mengakses dashboard?', 'a' => 'Hanya admin yang terdaftar yang bisa mengakses dashboard. Login menggunakan email dan password yang telah didaftarkan. Semua halaman dashboard dilindungi oleh autentikasi.'],
                    ];
                @endphp

                @foreach ($faqs as $index => $faq)
                    <div class="border border-edu-hairline rounded-xl overflow-hidden" :class="activeFaq === {{ $index }} ? 'border-edu-yellow/30' : ''">
                        <button
                            @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-edu-card/50 transition-colors"
                        >
                            <span class="text-sm font-medium text-edu-text pr-4">{{ $faq['q'] }}</span>
                            <svg
                                class="w-5 h-5 text-edu-muted shrink-0 transition-transform duration-200"
                                :class="activeFaq === {{ $index }} ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div
                            x-show="activeFaq === {{ $index }}"
                            x-collapse
                            class="px-6 pb-4"
                        >
                            <p class="text-sm text-edu-muted leading-relaxed">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="edu-card border border-edu-yellow/20 bg-gradient-to-br from-edu-yellow/5 to-transparent text-center py-16 px-8 rounded-2xl">
                <h2 class="text-3xl md:text-4xl font-bold text-edu-text tracking-tight">
                    Siap Mengelola Nilai Mahasiswa?
                </h2>
                <p class="mt-4 text-edu-muted text-lg max-w-xl mx-auto">
                    Mulai gunakan EduGrade untuk mengelola data akademik secara terintegrasi.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="edu-btn-primary px-8 py-3">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="edu-btn-primary px-8 py-3">
                            Buat Akun Gratis
                        </a>
                        <a href="{{ route('login') }}" class="edu-btn-secondary px-8 py-3">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

</x-layouts.landing>
