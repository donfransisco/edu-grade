@props(['paginator'])

@if ($paginator->hasPages())
    @php
        $links = $paginator->links('', ['class' => 'flex items-center gap-1']);
    @endphp

    <nav class="flex items-center justify-between">
        <p class="text-sm text-edu-muted">
            Menampilkan {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
        </p>

        <div class="flex items-center gap-1">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-sm text-edu-muted/50 bg-edu-card border border-edu-hairline rounded-lg cursor-not-allowed">
                    Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-edu-muted bg-edu-card border border-edu-hairline rounded-lg hover:text-edu-text hover:border-edu-yellow/30 transition-colors">
                    Prev
                </a>
            @endif

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($i == $paginator->currentPage())
                    <span class="px-3 py-1.5 text-sm bg-edu-yellow text-edu-ink font-semibold rounded-lg">
                        {{ $i }}
                    </span>
                @else
                    <a href="{{ $paginator->url($i) }}" class="px-3 py-1.5 text-sm text-edu-muted bg-edu-card border border-edu-hairline rounded-lg hover:text-edu-text hover:border-edu-yellow/30 transition-colors">
                        {{ $i }}
                    </a>
                @endif
            @endfor

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-edu-muted bg-edu-card border border-edu-hairline rounded-lg hover:text-edu-text hover:border-edu-yellow/30 transition-colors">
                    Next
                </a>
            @else
                <span class="px-3 py-1.5 text-sm text-edu-muted/50 bg-edu-card border border-edu-hairline rounded-lg cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    </nav>
@endif
