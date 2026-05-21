@extends('layouts.dashboard')

@section('title', 'Modifier la candidature - CandidatureTracker')

@section('content')
<div class="max-w-2xl mx-auto w-full">
    <div class="mb-stack-lg">
        <a href="{{ route('candidatures.show', $candidature) }}" class="inline-flex items-center gap-1 text-on-surface-variant hover:text-primary text-body-sm mb-4 transition-colors">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Retour au détail
        </a>
        <h1 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-surface">Modifier la candidature</h1>
        <p class="text-body-sm text-on-surface-variant mt-2">Mettez à jour les informations de votre candidature.</p>
    </div>

    <div class="bg-surface-container-lowest rounded-xl p-6 md:p-8 soft-shadow">
        <form method="POST" action="{{ route('candidatures.update', $candidature) }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                <div class="md:col-span-1">
                    <x-input-label for="entreprise" value="Entreprise *" />
                    <x-text-input id="entreprise" name="entreprise" type="text" class="mt-1 block w-full" :value="old('entreprise', $candidature->entreprise)" placeholder="Ex: Google, Acme Corp" />
                    <x-input-error :messages="$errors->get('entreprise')" class="mt-1" />
                </div>

                <div class="md:col-span-1">
                    <x-input-label for="poste" value="Poste visé *" />
                    <x-text-input id="poste" name="poste" type="text" class="mt-1 block w-full" :value="old('poste', $candidature->poste)" placeholder="Ex: Développeur Full-Stack" />
                    <x-input-error :messages="$errors->get('poste')" class="mt-1" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="url_offre" value="URL de l'offre" />
                    <x-text-input id="url_offre" name="url_offre" type="url" class="mt-1 block w-full" :value="old('url_offre', $candidature->url_offre)" placeholder="https://..." />
                    <x-input-error :messages="$errors->get('url_offre')" class="mt-1" />
                </div>

                <div class="md:col-span-1">
                    <x-input-label for="statut" value="Statut" />
                    <select id="statut" name="statut" class="mt-1 block w-full border-outline-variant rounded-lg text-body-sm text-on-surface focus:border-primary focus:ring-primary-container shadow-sm bg-surface-container-lowest">
                        <option value="envoyée" @selected(old('statut', $candidature->statut) === 'envoyée')>Envoyée</option>
                        <option value="en_cours" @selected(old('statut', $candidature->statut) === 'en_cours')>En cours</option>
                        <option value="entretien" @selected(old('statut', $candidature->statut) === 'entretien')>Entretien</option>
                        <option value="offre" @selected(old('statut', $candidature->statut) === 'offre')>Offre reçue</option>
                        <option value="refusée" @selected(old('statut', $candidature->statut) === 'refusée')>Refusée</option>
                        <option value="abandonnée" @selected(old('statut', $candidature->statut) === 'abandonnée')>Abandonnée</option>
                    </select>
                    <x-input-error :messages="$errors->get('statut')" class="mt-1" />
                </div>

                <div class="md:col-span-1">
                    <x-input-label for="priorite" value="Priorité" />
                    <select id="priorite" name="priorite" class="mt-1 block w-full border-outline-variant rounded-lg text-body-sm text-on-surface focus:border-primary focus:ring-primary-container shadow-sm bg-surface-container-lowest">
                        <option value="haute" @selected(old('priorite', $candidature->priorite) === 'haute')>Haute</option>
                        <option value="moyenne" @selected(old('priorite', $candidature->priorite) === 'moyenne')>Moyenne</option>
                        <option value="faible" @selected(old('priorite', $candidature->priorite) === 'faible')>Faible</option>
                    </select>
                    <x-input-error :messages="$errors->get('priorite')" class="mt-1" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="date_candidature" value="Date de candidature" />
                    <x-text-input id="date_candidature" name="date_candidature" type="date" class="mt-1 block w-full" :value="old('date_candidature', $candidature->date_candidature->format('Y-m-d'))" />
                    <x-input-error :messages="$errors->get('date_candidature')" class="mt-1" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="notes" value="Notes" />
                    <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full border-outline-variant rounded-lg text-body-sm text-on-surface focus:border-primary focus:ring-primary-container shadow-sm bg-surface-container-lowest resize-y" placeholder="Remarques, contacts, détails importants...">{{ old('notes', $candidature->notes) }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label value="CV / Lettre de motivation" />
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-outline-variant border-dashed rounded-lg hover:border-primary transition-colors cursor-pointer bg-surface-container-lowest">
                        <div class="space-y-1 text-center">
                            <span class="material-symbols-outlined text-outline-variant text-4xl mb-2" style="font-variation-settings: 'wght' 200;">upload_file</span>
                            <div class="flex text-sm text-on-surface-variant justify-center">
                                <label class="relative cursor-pointer bg-surface-container-lowest rounded-md font-medium text-primary hover:text-primary-container focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                    <span>Téléverser un fichier</span>
                                    <input type="file" name="fichier" class="sr-only" />
                                </label>
                                <p class="pl-1">ou glisser-déposer</p>
                            </div>
                            <p class="text-xs text-on-surface-variant">PDF, DOC, DOCX (Max. 5MB)</p>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('fichier')" class="mt-1" />
                </div>
            </div>

            <div class="pt-6 mt-6 border-t border-surface-variant flex items-center justify-end gap-4">
                <a href="{{ route('candidatures.show', $candidature) }}" class="px-6 py-2 rounded-lg text-body-sm font-medium text-primary border border-transparent hover:bg-surface-container-low focus:outline-none focus:ring-2 focus:ring-primary-container transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 rounded-lg text-body-sm font-medium bg-primary text-on-primary hover:bg-surface-tint focus:outline-none focus:ring-2 focus:ring-primary transition-colors shadow-sm">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection