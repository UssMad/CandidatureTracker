@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-lg border border-outline bg-surface-container-lowest px-3 py-2.5 text-body-lg text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
