<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-sm mt-4']) }}>
    {{ $slot }}
</button>
