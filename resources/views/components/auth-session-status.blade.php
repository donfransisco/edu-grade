@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-edu-success bg-edu-success/10 border border-edu-success/20 rounded-lg p-3']) }}>
        {{ $status }}
    </div>
@endif
