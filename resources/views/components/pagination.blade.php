@props(['paginator'])

@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $window = 2;

        $pages = [];
        for ($i = max(1, $currentPage - $window); $i <= min($lastPage, $currentPage + $window); $i++) {
            $pages[] = $i;
        }

        $withFirst = ! in_array(1, $pages);
        $withLast = ! in_array($lastPage, $pages);
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

            @if ($withFirst)
                <a href="{{ $paginator->url(1) }}" class="px-3 py-1.5 text-sm text-edu-muted bg-edu-card border border-edu-hairline rounded-lg hover:text-edu-text hover:border-edu-yellow/30 transition-colors">
                    1
                </a>
                @if ($pages[0] > 2)
                    <span class="px-2 py-1.5 text-sm text-edu-muted/50">...</span>
                @endif
            @endif

            @foreach ($pages as $page)
                @if ($page == $currentPage)
                    <span class="px-3 py-1.5 text-sm bg-edu-yellow text-edu-ink font-semibold rounded-lg">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}" class="px-3 py-1.5 text-sm text-edu-muted bg-edu-card border border-edu-hairline rounded-lg hover:text-edu-text hover:border-edu-yellow/30 transition-colors">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if ($withLast)
                @if ($lastPage > end($pages) + 1)
                    <span class="px-2 py-1.5 text-sm text-edu-muted/50">...</span>
                @endif
                <a href="{{ $paginator->url($lastPage) }}" class="px-3 py-1.5 text-sm text-edu-muted bg-edu-card border border-edu-hairline rounded-lg hover:text-edu-text hover:border-edu-yellow/30 transition-colors">
                    {{ $lastPage }}
                </a>
            @endif

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
