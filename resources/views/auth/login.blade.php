<x-guest-layout>
    <div class="text-center mb-6">
        <div class="mx-auto w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center mb-3">
            <span class="material-symbols-outlined text-primary" style="font-size: 28px;">login</span>
        </div>
        <h2 class="text-headline-md font-semibold text-on-surface">Connexion</h2>
        <p class="text-body-sm text-on-surface-variant mt-1">Connectez-vous à votre compte</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                </span>
                <x-text-input id="email" class="pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="exemple@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </span>
                <x-text-input id="password" class="pl-10" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer group">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-outline text-primary focus:ring-primary/20 focus:ring-2 transition-all" name="remember">
                <span class="text-body-sm text-on-surface-variant group-hover:text-on-surface transition-colors">{{ __('Se souvenir de moi') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-body-sm font-medium text-primary hover:text-primary-container transition-colors" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center py-3">
            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            {{ __('Se connecter') }}
        </x-primary-button>

        <p class="text-center text-body-sm text-on-surface-variant">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary-container transition-colors">S'inscrire</a>
        </p>
    </form>
</x-guest-layout>
