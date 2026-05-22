<section>
    <p class="text-body-sm text-on-surface-variant mb-5">Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.</p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </span>
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="pl-10" autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">key</span>
                </span>
                <x-text-input id="update_password_password" name="password" type="password" class="pl-10" autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </span>
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="pl-10" autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>
                <span class="material-symbols-outlined text-[18px]">save</span>
                {{ __('Enregistrer') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="profile-saved flex items-center gap-2 text-body-sm text-secondary font-medium"
                >
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    Enregistré.
                </p>
            @endif
        </div>
    </form>
</section>
