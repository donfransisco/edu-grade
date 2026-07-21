@props(['value'])

<label {{ $attributes->merge(['class' => 'edu-label']) }}>
    {{ $value ?? $slot }}
</label>
