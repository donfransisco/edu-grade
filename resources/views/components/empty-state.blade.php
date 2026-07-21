@props(['icon' => 'inbox', 'title' => 'Belum ada data', 'description' => 'Data akan muncul di sini setelah ditambahkan.'])

<div class="flex flex-col items-center justify-center py-16 text-center">
    <div class="w-16 h-16 bg-edu-card border border-edu-hairline rounded-full flex items-center justify-center mb-4">
        @if ($icon === 'inbox')
            <svg class="w-8 h-8 text-edu-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
        @elseif ($icon === 'search')
            <svg class="w-8 h-8 text-edu-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        @endif
    </div>
    <h3 class="text-sm font-medium text-edu-text">{{ $title }}</h3>
    <p class="mt-1 text-sm text-edu-muted">{{ $description }}</p>
    {{ $slot }}
</div>
