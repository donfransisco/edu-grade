@props(['href', 'active' => false])

@php
$classes = $active
    ? 'block w-full px-4 py-2 text-sm text-edu-yellow bg-edu-yellow/10'
    : 'block w-full px-4 py-2 text-sm text-edu-muted hover:text-edu-text hover:bg-edu-elevated';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
    {{ $slot }}
</a>
