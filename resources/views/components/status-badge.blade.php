@props(['statut' => ''])

@php
$styles = match($statut) {
    'envoyée' => 'bg-blue-50 text-blue-700',
    'entretien' => 'bg-green-50 text-green-700',
    'en_cours' => 'bg-yellow-50 text-yellow-800',
    'offre' => 'bg-purple-50 text-purple-700',
    'refusée' => 'bg-gray-100 text-gray-600',
    'abandonnée' => 'bg-gray-100 text-gray-500',
    default => 'bg-surface-container text-on-surface-variant',
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-badge font-medium {$styles}"]) }}>
    {{ $slot }}
</span>