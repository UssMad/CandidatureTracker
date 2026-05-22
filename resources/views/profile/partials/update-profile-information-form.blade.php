<section>
    <p class="text-body-sm text-on-surface-variant mb-5">Mettez à jour les informations de votre compte et votre adresse email.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </span>
                <x-text-input id="name" name="name" type="text" class="pl-10" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="mt-1.5 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-on-surface-variant">
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                </span>
                <x-text-input id="email" name="email" type="email" class="pl-10" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-body-sm text-on-surface-variant">
                        Votre adresse email n'est pas vérifiée.

                        <button form="send-verification" class="font-medium text-primary hover:text-primary-container transition-colors underline">
                            Cliquez ici pour renvoyer l'email de vérification.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 flex items-center gap-2 text-body-sm text-secondary">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>
                <span class="material-symbols-outlined text-[18px]">save</span>
                {{ __('Enregistrer') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
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
