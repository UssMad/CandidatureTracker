@props(['title' => '', 'message' => '', 'actionRoute' => null, 'actionLabel' => null, 'icon' => 'post_add'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-20 px-4 text-center']) }}>
    <div class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center mb-6">
        <span class="material-symbols-outlined text-4xl text-outline-variant">{{ $icon }}</span>
    </div>
    @if($title)
        <h3 class="text-headline-md font-semibold text-on-surface mb-2">{{ $title }}</h3>
    @endif
    @if($message)
        <p class="text-body-lg text-on-surface-variant max-w-md mb-8">{{ $message }}</p>
    @endif
    @if($actionRoute && $actionLabel)
        <a href="{{ $actionRoute }}" class="inline-flex items-center gap-2 bg-primary hover:bg-surface-tint text-on-primary px-6 py-3 rounded-lg text-body-sm font-medium transition-colors duration-200 shadow-sm">
            <span class="material-symbols-outlined">add</span>
            {{ $actionLabel }}
        </a>
    @endif
</div>