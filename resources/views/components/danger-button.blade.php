<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-error border border-transparent rounded-lg font-semibold text-sm text-on-error hover:bg-error-container hover:text-on-error-container focus:bg-error-container focus:text-on-error-container active:opacity-90 focus:outline-none focus:ring-2 focus:ring-error focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
