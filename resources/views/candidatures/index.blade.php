@extends('layouts.dashboard')

@section('title', 'Mes Candidatures - CandidatureTracker')

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-stack-md mb-stack-lg">
    <div>
        <h2 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-surface">Mes Candidatures</h2>
        <p class="text-body-sm text-on-surface-variant mt-1">Suivez l'avancement de vos recherches d'emploi.</p>
    </div>
    <div class="flex flex-col sm:flex-row items-center gap-4">
        <a href="{{ route('candidatures.create') }}" class="flex-shrink-0 bg-primary hover:bg-surface-tint text-on-primary px-6 py-2 rounded-lg text-body-sm font-medium transition-colors duration-200 flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span class="hidden sm:inline">Nouvelle Candidature</span>
        </a>
    </div>
</div>

<form method="GET" action="{{ route('candidatures.index') }}" class="flex flex-wrap items-center gap-4 mb-stack-lg">
    <div class="relative flex-1 min-w-[200px] max-w-xs">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary-container focus:border-primary transition-all placeholder-outline-variant">
    </div>
    <select name="statut" onchange="this.form.submit()" class="px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary-container focus:border-primary transition-all appearance-none cursor-pointer pr-8 bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23727785%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:12px_auto] bg-no-repeat bg-[position:right_12px_center]">
        <option value="">Tous les statuts</option>
        <option value="envoyée" @selected(request('statut') === 'envoyée')>Envoyée</option>
        <option value="en_cours" @selected(request('statut') === 'en_cours')>En cours</option>
        <option value="entretien" @selected(request('statut') === 'entretien')>Entretien</option>
        <option value="offre" @selected(request('statut') === 'offre')>Offre reçue</option>
        <option value="refusée" @selected(request('statut') === 'refusée')>Refusée</option>
        <option value="abandonnée" @selected(request('statut') === 'abandonnée')>Abandonnée</option>
    </select>
    <select name="priorite" onchange="this.form.submit()" class="px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary-container focus:border-primary transition-all appearance-none cursor-pointer pr-8 bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23727785%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:12px_auto] bg-no-repeat bg-[position:right_12px_center]">
        <option value="">Toutes les priorités</option>
        <option value="haute" @selected(request('priorite') === 'haute')>Haute</option>
        <option value="moyenne" @selected(request('priorite') === 'moyenne')>Moyenne</option>
        <option value="faible" @selected(request('priorite') === 'faible')>Faible</option>
    </select>
    @if(request()->anyFilled(['statut', 'priorite', 'search']))
        <a href="{{ route('candidatures.index') }}" class="inline-flex items-center px-4 py-2 text-body-sm text-primary hover:text-primary-container transition-colors">
            Réinitialiser
        </a>
    @endif
</form>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-stack-md">
    @forelse($candidatures as $candidature)
    <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow hover-lift border border-transparent hover:border-surface-variant flex flex-col justify-between h-full group">
        <div>
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-surface-container flex items-center justify-center rounded-lg text-primary font-bold text-xl">
                    {{ strtoupper(substr($candidature->entreprise, 0, 1)) }}
                </div>
                <x-status-badge :statut="$candidature->statut">{{ $candidature->statut_label }}</x-status-badge>
            </div>
            <h3 class="text-headline-md font-semibold text-on-surface line-clamp-1">{{ $candidature->poste }}</h3>
            <p class="text-body-sm text-on-surface-variant mt-1">{{ $candidature->entreprise }}</p>
            <div class="mt-4">
                <x-priority-indicator :priorite="$candidature->priorite">{{ $candidature->priorite_label }}</x-priority-indicator>
            </div>
            <p class="text-body-sm text-outline mt-2">Postulé le {{ $candidature->date_candidature->format('d M Y') }}</p>
        </div>
        <div class="mt-6 pt-4 border-t border-outline-variant flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('candidatures.show', $candidature) }}" class="text-outline hover:text-primary transition-colors p-1" title="Voir">
                <span class="material-symbols-outlined text-[20px]">visibility</span>
            </a>
            <a href="{{ route('candidatures.edit', $candidature) }}" class="text-outline hover:text-primary transition-colors p-1" title="Modifier">
                <span class="material-symbols-outlined text-[20px]">edit</span>
            </a>
            <form method="POST" action="{{ route('candidatures.destroy', $candidature) }}" onsubmit="return confirm('Archiver cette candidature ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-outline hover:text-error transition-colors p-1" title="Archiver">
                    <span class="material-symbols-outlined text-[20px]">archive</span>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full">
        <x-empty-state
            title="Aucune candidature"
            message="Aucune candidature pour le moment. Commencez par en ajouter une pour suivre vos opportunités !"
            :actionRoute="route('candidatures.create')"
            actionLabel="Nouvelle Candidature"
        />
    </div>
    @endforelse
</div>
@endsection