<section class="space-y-5">
    <div class="flex items-start gap-4 p-4 rounded-lg bg-error-container/30 border border-error/20">
        <span class="material-symbols-outlined text-error flex-shrink-0 mt-0.5">warning</span>
        <div>
            <p class="text-body-sm font-medium text-on-surface">
                Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
            </p>
            <p class="text-body-sm text-on-surface-variant mt-1">
                Avant de supprimer votre compte, veuillez télécharger toutes les données que vous souhaitez conserver.
            </p>
        </div>
    </div>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        <span class="material-symbols-outlined text-[18px]">delete_forever</span>
        {{ __('Supprimer le compte') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-error">delete_forever</span>
                </div>
                <h2 class="text-headline-md font-semibold text-on-surface">
                    {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
                </h2>
            </div>

            <p class="text-body-sm text-on-surface-variant mb-5">
                Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer.
            </p>

            <div>
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">lock</span>
                    </span>
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="pl-10 w-full"
                        placeholder="{{ __('Mot de passe') }}"
                    />
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button>
                    <span class="material-symbols-outlined text-[18px]">delete_forever</span>
                    {{ __('Supprimer le compte') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
