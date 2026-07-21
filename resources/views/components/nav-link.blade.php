@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-edu-yellow text-sm font-medium leading-5 text-edu-text focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-edu-muted hover:text-edu-text transition duration-150 ease-in-out';
@endendphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
