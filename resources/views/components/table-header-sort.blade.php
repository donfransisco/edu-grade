@props(['label', 'field', 'sortBy', 'sortDir', 'baseUrl'])

@php
    $isActive = $sortBy === $field;
    $nextDir = $isActive && $sortDir === 'asc' ? 'desc' : 'asc';
    $arrow = $isActive ? ($sortDir === 'asc' ? '↑' : '↓') : '';
@endphp

<th class="px-3 py-2">
    <a href="{{ $baseUrl }}?{{ http_build_query(array_merge(request()->query(), ['sort_by' => $field, 'sort_dir' => $nextDir])) }}"
       class="inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-wider {{ $isActive ? 'text-edu-yellow' : 'text-edu-muted hover:text-edu-text' }} transition-colors">
        {{ $label }}
        @if ($isActive)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if ($sortDir === 'asc')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                @endif
            </svg>
        @endif
    </a>
</th>
