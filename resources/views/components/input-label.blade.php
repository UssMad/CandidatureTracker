@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-body-sm text-on-surface']) }}>
    {{ $value ?? $slot }}
</label>
