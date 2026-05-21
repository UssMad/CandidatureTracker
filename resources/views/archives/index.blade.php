@extends('layouts.dashboard')

@section('title', 'Mes Archives - CandidatureTracker')

@section('content')
<div class="mb-stack-lg flex justify-between items-end">
    <div>
        <h2 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-surface">Mes Archives</h2>
        <p class="text-body-lg text-on-surface-variant mt-2">Consultez vos candidatures passées ou inactives.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-stack-md">
    @forelse($candidatures as $candidature)
    <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow border border-outline-variant/30 flex flex-col opacity-80 grayscale-[0.2] hover:grayscale-0 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-surface-container rounded-lg flex items-center justify-center border border-outline-variant/50">
                    <span class="text-headline-md font-bold text-outline-variant">{{ strtoupper(substr($candidature->entreprise, 0, 1)) }}</span>
                </div>
                <div>
                    <h3 class="text-headline-md font-semibold text-on-surface-variant">{{ $candidature->entreprise }}</h3>
                    <p class="text-body-sm text-outline">{{ $candidature->poste }}</p>
                </div>
            </div>
            <span class="bg-surface-variant text-outline text-badge px-2 py-1 rounded-full uppercase tracking-wider">{{ $candidature->statut_label }}</span>
        </div>
        <div class="flex items-center gap-2 text-body-sm text-outline mb-4">
            <span class="material-symbols-outlined text-[16px]">archive</span>
            Archivée le {{ $candidature->deleted_at->format('d M Y') }}
        </div>
        <div class="mt-auto pt-4 border-t border-outline-variant/30 flex gap-3">
            <a href="{{ route('archives.show', $candidature->id) }}" class="flex-1 border border-outline-variant text-on-surface-variant text-body-sm py-2 rounded-lg hover:bg-surface-container-low transition-colors text-center">
                Voir le détail
            </a>
            <form method="POST" action="{{ route('archives.restore', $candidature->id) }}" class="flex-1">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-full bg-surface-container border border-outline-variant text-primary text-body-sm py-2 rounded-lg hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">restore</span> Restaurer
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full">
        <x-empty-state
            title="Aucune archive"
            message="Vous n'avez pas encore archivé de candidatures."
            icon="archive"
        />
    </div>
    @endforelse
</div>
@endsection