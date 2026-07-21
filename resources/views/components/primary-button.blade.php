<button {{ $attributes->merge(['type' => 'submit', 'class' => 'edu-btn-primary']) }}>
    {{ $slot }}
</button>
