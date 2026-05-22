<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-surface-container-lowest border border-outline rounded-lg font-semibold text-sm text-on-surface hover:bg-surface-container hover:text-primary focus:bg-surface-container focus:text-primary focus:outline-none focus:ring-2 focus:ring-primary/20 disabled:opacity-50 transition-all duration-200']) }}>
    {{ $slot }}
</button>
