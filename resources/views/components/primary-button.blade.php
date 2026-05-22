<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-primary border border-transparent rounded-lg font-semibold text-sm text-on-primary hover:bg-primary-container hover:text-on-primary-container focus:bg-primary-container focus:text-on-primary-container active:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
