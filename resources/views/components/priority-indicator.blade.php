@props(['priorite' => ''])

@php
$dotColor = match($priorite) {
    'haute' => 'bg-red-500',
    'moyenne' => 'bg-yellow-500',
    'faible' => 'bg-green-500',
    default => 'bg-outline',
};
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <div class="w-2 h-2 rounded-full {{ $dotColor }}"></div>
    <span class="text-label-caps text-on-surface-variant uppercase tracking-wider">{{ $slot }}</span>
</div>