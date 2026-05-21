@extends('layouts.dashboard')

@section('title', 'Détail de la candidature - CandidatureTracker')

@section('content')
<div class="mb-stack-lg flex flex-col gap-stack-sm">
    <a href="{{ route('candidatures.index') }}" class="inline-flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors w-fit text-body-sm group">
        <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
        Retour aux candidatures
    </a>
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-stack-md mt-stack-sm">
        <div class="flex items-center gap-stack-md">
            <div class="w-16 h-16 rounded-xl bg-surface-container flex items-center justify-center text-primary font-bold text-2xl border border-outline-variant flex-shrink-0">
                {{ strtoupper(substr($candidature->entreprise, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-surface">{{ $candidature->poste }}</h1>
                <p class="text-body-lg text-on-surface-variant mt-1 flex items-center gap-2">
                    {{ $candidature->entreprise }}
                </p>
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <form method="POST" action="{{ route('candidatures.destroy', $candidature) }}" onsubmit="return confirm('Archiver cette candidature ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center gap-2 px-4 py-2 border border-outline-variant rounded-lg text-on-surface hover:bg-surface-container-low transition-colors text-body-sm">
                    <span class="material-symbols-outlined text-[18px]">archive</span>
                    Archiver
                </button>
            </form>
            @if($candidature->url_offre)
            <a href="{{ $candidature->url_offre }}" target="_blank" class="flex items-center gap-2 px-4 py-2 border border-primary text-primary rounded-lg hover:bg-surface-container-low transition-colors text-body-sm">
                <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                Lien de l'offre
            </a>
            @endif
            <a href="{{ route('candidatures.edit', $candidature) }}" class="flex items-center gap-2 px-4 py-2 bg-primary text-on-primary rounded-lg hover:bg-surface-tint transition-colors text-body-sm shadow-sm">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                Modifier
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-12 gap-stack-md">
    <div class="md:col-span-8 flex flex-col gap-stack-md">
        {{-- Info Row --}}
        <section class="bg-surface-container-lowest rounded-xl p-6 soft-shadow border border-surface-container-highest">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-stack-md">
                <div>
                    <p class="text-label-caps text-outline uppercase mb-2">Statut</p>
                    <x-status-badge :statut="$candidature->statut" class="text-sm">{{ $candidature->statut_label }}</x-status-badge>
                </div>
                <div>
                    <p class="text-label-caps text-outline uppercase mb-2">Priorité</p>
                    <x-priority-indicator :priorite="$candidature->priorite">{{ $candidature->priorite_label }}</x-priority-indicator>
                </div>
                <div>
                    <p class="text-label-caps text-outline uppercase mb-2">Date d'envoi</p>
                    <p class="text-body-sm text-on-surface">{{ $candidature->date_candidature->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-label-caps text-outline uppercase mb-2">Créée le</p>
                    <p class="text-body-sm text-on-surface">{{ $candidature->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </section>

        {{-- Notes --}}
        @if($candidature->notes)
        <section class="bg-surface-container-lowest rounded-xl p-6 soft-shadow border border-surface-container-highest">
            <h2 class="text-headline-md font-semibold text-on-surface mb-stack-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-outline">notes</span>
                Notes
            </h2>
            <div class="w-full p-4 rounded-lg bg-surface-container-low border border-surface-container-highest text-body-sm text-on-surface-variant leading-relaxed whitespace-pre-wrap">
                {{ $candidature->notes }}
            </div>
        </section>
        @endif

        {{-- Interviews Timeline --}}
        <section class="bg-surface-container-lowest rounded-xl p-6 soft-shadow border border-surface-container-highest">
            <div class="flex items-center justify-between mb-stack-md">
                <h2 class="text-headline-md font-semibold text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-outline">calendar_month</span>
                    Entretiens
                </h2>
                <button type="button" x-data x-on:click="$dispatch('open-modal', 'add-interview')" class="text-primary text-body-sm flex items-center gap-1 hover:underline">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Ajouter
                </button>
            </div>

            @if($candidature->entretiens->isNotEmpty())
            <div class="relative border-l border-outline-variant ml-3 space-y-stack-md py-2">
                @foreach($candidature->entretiens as $entretien)
                <div class="relative pl-6">
                    <span class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full {{ $entretien->resultat === 'positif' ? 'bg-secondary' : ($entretien->resultat === 'négatif' ? 'bg-error' : 'bg-outline-variant') }} border-2 border-surface-container-lowest"></span>
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-1">
                        <h3 class="text-body-lg font-semibold text-on-surface">{{ $entretien->type_label }}</h3>
                        <span class="text-body-sm text-outline">{{ $entretien->date_heure->format('d M Y à H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-body-sm text-on-surface-variant mb-2">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">{{ $entretien->type === 'visio' ? 'videocam' : ($entretien->type === 'présentiel' ? 'apartment' : ($entretien->type === 'téléphonique' ? 'phone' : 'code')) }}</span>
                            {{ $entretien->type_label }}
                        </span>
                        <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                        <span class="flex items-center gap-1">
                            @if($entretien->statut === 'accepté')
                                <span class="text-secondary"><span class="material-symbols-outlined text-[16px]">check_circle</span> Accepté</span>
                            @elseif($entretien->statut === 'Refusé')
                                <span class="text-error"><span class="material-symbols-outlined text-[16px]">cancel</span> Refusé</span>
                            @else
                                <span class="text-tertiary-container"><span class="material-symbols-outlined text-[16px]">schedule</span> {{ $entretien->statut_label }}</span>
                            @endif
                        </span>
                    </div>
                    @if($entretien->notes_preparation)
                    <p class="text-body-sm text-on-surface bg-surface p-3 rounded-lg border border-surface-variant">
                        <strong>Notes :</strong> {{ $entretien->notes_preparation }}
                    </p>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <p class="text-body-sm text-on-surface-variant text-center py-8">Aucun entretien planifié pour le moment.</p>
            @endif
        </section>
    </div>

    {{-- Side Column --}}
    <div class="md:col-span-4 flex flex-col gap-stack-md">
        {{-- Attachments --}}
        <section class="bg-surface-container-lowest rounded-xl p-6 soft-shadow border border-surface-container-highest">
            <h2 class="text-headline-md font-semibold text-on-surface mb-stack-md flex items-center gap-2">
                <span class="material-symbols-outlined text-outline">attachment</span>
                Pièces jointes
            </h2>
            @forelse($candidature->fichiers as $fichier)
            <ul class="flex flex-col gap-3">
                <li class="flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:border-primary transition-colors group">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-8 h-8 rounded bg-primary-fixed text-primary flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[18px]">description</span>
                        </div>
                        <div class="truncate">
                            <p class="text-body-sm text-on-surface truncate">{{ $fichier->nom_fichier }}</p>
                        </div>
                    </div>
                    <a href="{{ Storage::disk('public')->url($fichier->chemin) }}" download class="text-outline hover:text-primary transition-colors p-1" aria-label="Télécharger">
                        <span class="material-symbols-outlined">download</span>
                    </a>
                </li>
            </ul>
            @empty
            <p class="text-body-sm text-on-surface-variant text-center py-4">Aucun fichier joint.</p>
            @endforelse
            <button class="mt-stack-sm w-full py-2 border-2 border-dashed border-outline-variant rounded-lg text-outline hover:border-primary hover:text-primary transition-colors text-body-sm flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">upload</span>
                Ajouter un document
            </button>
        </section>

        {{-- Company Info --}}
        <section class="bg-surface-container-lowest rounded-xl p-6 soft-shadow border border-surface-container-highest">
            <h2 class="text-headline-md font-semibold text-on-surface mb-stack-sm">À propos de l'entreprise</h2>
            <p class="text-body-sm text-on-surface-variant mb-4">{{ $candidature->entreprise }}</p>
            @if($candidature->url_offre)
            <div class="flex items-center gap-2 text-body-sm text-on-surface mb-2">
                <span class="material-symbols-outlined text-outline text-[18px]">link</span>
                <a href="{{ $candidature->url_offre }}" target="_blank" class="text-primary hover:underline truncate">{{ $candidature->url_offre }}</a>
            </div>
            @endif
        </section>
    </div>
</div>

{{-- Add Interview Modal --}}
<div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }" x-show="open" x-cloak
     @open-modal.window="if ($event.detail === 'add-interview') open = true"
     x-on:keydown.escape.window="open = false"
     class="fixed inset-0 z-50 overflow-y-auto"
     x-transition:enter="transition-opacity ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black/40" @click="open = false"></div>
        <div class="relative bg-surface-container-lowest rounded-xl shadow-xl p-6 md:p-8 w-full max-w-lg z-10" @click.away="open = false">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-headline-md font-semibold text-on-surface">Ajouter un entretien</h2>
                <button @click="open = false" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form method="POST" action="{{ route('candidatures.entretiens.store', $candidature) }}">
                @csrf
                @if ($errors->any())
                    <div class="bg-error-container text-on-error-container px-4 py-3 rounded-lg mb-4 text-body-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="space-y-4">
                    <div>
                        <x-input-label for="type" value="Type d'entretien" />
                        <select id="type" name="type" class="mt-1 block w-full border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-primary-container shadow-sm bg-surface-container-lowest">
                            <option value="téléphonique">Téléphonique</option>
                            <option value="visio">Visio</option>
                            <option value="présentiel">Présentiel</option>
                            <option value="technique">Technique</option>
                            <option value="RH">RH</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="date_heure" value="Date et heure" />
                        <x-text-input id="date_heure" name="date_heure" type="datetime-local" class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-input-label for="statut" value="Statut" />
                        <select id="statut" name="statut" class="mt-1 block w-full border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-primary-container shadow-sm bg-surface-container-lowest">
                            <option value="En attente">En attente</option>
                            <option value="Refusé">Refusé</option>
                            <option value="accepté">Accepté</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="resultat" value="Résultat" />
                        <select id="resultat" name="resultat" class="mt-1 block w-full border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-primary-container shadow-sm bg-surface-container-lowest">
                            <option value="en_attente">En attente</option>
                            <option value="positif">Positif</option>
                            <option value="négatif">Négatif</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="notes_preparation" value="Notes de préparation" />
                        <textarea id="notes_preparation" name="notes_preparation" rows="3" class="mt-1 block w-full border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-primary-container shadow-sm bg-surface-container-lowest resize-y"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="open = false" class="px-4 py-2 rounded-lg text-body-sm font-medium text-primary hover:bg-surface-container-low transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg text-body-sm font-medium bg-primary text-on-primary hover:bg-surface-tint transition-colors shadow-sm">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection