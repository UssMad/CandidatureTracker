@extends('layouts.dashboard')

@section('title', 'Paramètres')

@push('styles')
<style>
    .profile-saved {
        animation: fadeInUp 0.3s ease-out;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-2">
            <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center">
                <span class="material-symbols-outlined text-primary" style="font-size: 28px;">settings</span>
            </div>
            <div>
                <h1 class="text-headline-lg text-on-surface">Paramètres</h1>
                <p class="text-body-sm text-on-surface-variant">Gérez vos informations personnelles et la sécurité de votre compte</p>
            </div>
        </div>

        {{-- Update Profile Information --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl soft-shadow">
            <div class="px-6 py-5 border-b border-outline-variant flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">person</span>
                <h2 class="text-headline-md font-semibold text-on-surface">Informations du profil</h2>
            </div>
            <div class="px-6 py-5">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl soft-shadow">
            <div class="px-6 py-5 border-b border-outline-variant flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">key</span>
                <h2 class="text-headline-md font-semibold text-on-surface">Mot de passe</h2>
            </div>
            <div class="px-6 py-5">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl soft-shadow">
            <div class="px-6 py-5 border-b border-outline-variant flex items-center gap-3">
                <span class="material-symbols-outlined text-error">delete_forever</span>
                <h2 class="text-headline-md font-semibold text-on-surface">Zone dangereuse</h2>
            </div>
            <div class="px-6 py-5">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
