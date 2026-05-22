@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-2 px-4 py-3 rounded-lg bg-secondary-container text-on-secondary-container text-body-sm font-medium']) }}>
        <span class="material-symbols-outlined text-[18px]">check_circle</span>
        {{ $status }}
    </div>
@endif
