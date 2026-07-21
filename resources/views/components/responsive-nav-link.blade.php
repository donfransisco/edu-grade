@props(['href', 'active' => false])

@php
$classes = $active
    ? 'block ps-3 pe-4 pt-2 pb-2 border-l-2 border-edu-yellow text-base font-semibold text-edu-yellow bg-edu-yellow/10 focus:outline-none transition duration-150 ease-in-out'
    : 'block ps-3 pe-4 pt-2 pb-2 border-l-2 border-transparent text-base font-medium text-edu-muted hover:text-edu-text hover:bg-edu-card focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
    {{ $slot }}
</a>
