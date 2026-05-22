<x-guest-layout>
    <div class="text-center mb-6">
        <div class="mx-auto w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-primary" style="font-size: 28px;">person_add</span>
        </div>
        <h2 class="text-headline-md font-semibold text-on-surface">Inscription</h2>
        <p class="text-body-sm text-on-surface-variant mt-1">Créez votre compte</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </span>
                <x-text-input id="name" class="pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Jean Dupont" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                </span>
                <x-text-input id="email" class="pl-10" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="exemple@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </span>
                <x-text-input id="password" class="pl-10" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </span>
                <x-text-input id="password_confirmation" class="pl-10" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            {{ __('S\'inscrire') }}
        </x-primary-button>

        <p class="text-center text-body-sm text-on-surface-variant">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-container transition-colors">Se connecter</a>
        </p>
    </form>
</x-guest-layout>
