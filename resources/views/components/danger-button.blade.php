<button {{ $attributes->merge(['type' => 'submit', 'class' => 'edu-btn-danger']) }}>
    {{ $slot }}
</button>
