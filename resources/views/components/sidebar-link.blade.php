@props(['href', 'active' => false, 'icon'])

@php
$classes = $active
    ? 'flex items-center gap-3 px-4 py-3 rounded-lg text-primary font-semibold bg-surface-container-low border-l-4 border-primary transition-colors duration-200'
    : 'flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors duration-200';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <span class="material-symbols-outlined" @if($active) style="font-variation-settings: 'FILL' 1;" @endif>{{ $icon }}</span>
    <span>{{ $slot }}</span>
</a>