<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CandidatureTracker') }} — Suivez vos candidatures sereinement</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    @endif

    <style>
        .soft-shadow { box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05); }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -2px rgb(0 0 0 / 0.05); }
    </style>
</head>
<body class="font-inter bg-background text-on-surface antialiased">

    {{-- Nav --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-primary text-[18px]" style="font-variation-settings: 'FILL' 1;">work</span>
                    </div>
                    <span class="text-headline-md font-semibold text-primary">CandidatureTracker</span>
                </a>
                <nav class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/candidatures') }}" class="bg-primary hover:bg-surface-tint text-on-primary px-5 py-2 rounded-lg text-body-sm font-medium transition-colors shadow-sm">
                                Tableau de bord
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-on-surface-variant hover:text-primary text-body-sm font-medium transition-colors px-3 py-2">
                                Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-primary hover:bg-surface-tint text-on-primary px-5 py-2 rounded-lg text-body-sm font-medium transition-colors shadow-sm">
                                    Créer un compte
                                </a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </div>
    </header>

    {{-- Hero --}}
    <section class="min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="max-w-xl">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed text-badge font-medium mb-6">
                        Votre carrière, organisée
                    </span>
                    <h1 class="text-headline-lg-mobile md:text-5xl lg:text-[56px] font-bold text-on-surface leading-[1.1] tracking-tight">
                        Suivez vos candidatures<br>
                        <span class="text-primary">avec sérénité</span>
                    </h1>
                    <p class="text-body-lg text-on-surface-variant mt-6 max-w-lg leading-relaxed">
                        Centralisez, organisez et suivez l'avancement de vos recherches d'emploi. 
                        Ne laissez plus aucune opportunité vous échapper.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-surface-tint text-on-primary px-8 py-3 rounded-lg text-body-sm font-medium transition-colors shadow-sm">
                                Commencer gratuitement
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        @endif
                        <a href="#features" class="inline-flex items-center justify-center gap-2 border border-outline-variant text-on-surface hover:bg-surface-container-low px-8 py-3 rounded-lg text-body-sm font-medium transition-colors">
                            En savoir plus
                        </a>
                    </div>
                    <div class="flex items-center gap-6 mt-10 pt-8 border-t border-outline-variant">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface flex items-center justify-center text-xs font-medium text-on-surface-variant">JD</div>
                            <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface flex items-center justify-center text-xs font-medium text-on-surface-variant">AL</div>
                            <div class="w-8 h-8 rounded-full bg-surface-container-highest border-2 border-surface flex items-center justify-center text-xs font-medium text-on-surface-variant">MP</div>
                        </div>
                        <p class="text-body-sm text-on-surface-variant">
                            <span class="font-semibold text-on-surface">+500</span> jeunes diplômés utilisent CandidatureTracker
                        </p>
                    </div>
                </div>
                <div class="hidden lg:flex justify-center">
                    <div class="relative w-full max-w-lg">
                        {{-- Dashboard preview card mockup --}}
                        <div class="bg-surface-container-lowest rounded-2xl p-6 soft-shadow border border-outline-variant">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary text-[20px]" style="font-variation-settings: 'FILL' 1;">work</span>
                                    </div>
                                    <div>
                                        <p class="text-body-sm font-semibold text-on-surface">CandidatureTracker</p>
                                        <p class="text-badge text-on-surface-variant">Tableau de bord</p>
                                    </div>
                                </div>
                                <div class="w-2 h-2 rounded-full bg-secondary"></div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 bg-surface-container rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-surface-container-lowest rounded flex items-center justify-center text-sm font-bold text-primary">G</div>
                                        <div>
                                            <p class="text-body-sm font-medium text-on-surface">Développeur Front-end</p>
                                            <p class="text-badge text-on-surface-variant">Google • Paris</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 text-badge">Envoyée</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-surface-container rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-surface-container-lowest rounded flex items-center justify-center text-sm font-bold text-primary">S</div>
                                        <div>
                                            <p class="text-body-sm font-medium text-on-surface">Product Designer</p>
                                            <p class="text-badge text-on-surface-variant">Stripe • Remote</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full bg-green-50 text-green-700 text-badge">Entretien</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-surface-container rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-surface-container-lowest rounded flex items-center justify-center text-sm font-bold text-primary">D</div>
                                        <div>
                                            <p class="text-body-sm font-medium text-on-surface">UX Researcher</p>
                                            <p class="text-badge text-on-surface-variant">Doctolib • Nantes</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full bg-yellow-50 text-yellow-800 text-badge">En attente</span>
                                </div>
                            </div>
                        </div>
                        {{-- Floating card --}}
                        <div class="absolute -bottom-4 -right-4 bg-surface-container-lowest rounded-xl p-4 soft-shadow border border-outline-variant max-w-[200px]">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-secondary"></div>
                                <div>
                                    <p class="text-badge font-semibold text-on-surface">Entretien demain</p>
                                    <p class="text-badge text-on-surface-variant">Test Technique • 10:00</p>
                                </div>
                            </div>
                        </div>
                        {{-- Gradient decoration --}}
                        <div class="absolute -z-10 -top-8 -left-8 w-72 h-72 bg-primary-fixed rounded-full opacity-20 blur-3xl"></div>
                        <div class="absolute -z-10 -bottom-8 -right-8 w-72 h-72 bg-secondary-fixed rounded-full opacity-20 blur-3xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="py-20 lg:py-32 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed text-badge font-medium mb-4">
                    Fonctionnalités
                </span>
                <h2 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-surface">
                    Tout ce dont vous avez besoin<br>pour gérer vos candidatures
                </h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow hover-lift border border-transparent hover:border-surface-variant">
                    <div class="w-12 h-12 bg-primary-fixed rounded-lg flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Tableau de bord</h3>
                    <p class="text-body-sm text-on-surface-variant leading-relaxed">
                        Visualisez toutes vos candidatures en un coup d'œil. Filtrez par statut et priorité pour rester concentré sur l'essentiel.
                    </p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow hover-lift border border-transparent hover:border-surface-variant">
                    <div class="w-12 h-12 bg-secondary-fixed rounded-lg flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">calendar_month</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Suivi des entretiens</h3>
                    <p class="text-body-sm text-on-surface-variant leading-relaxed">
                        Planifiez et suivez chaque étape de vos entretiens. Chronologie claire avec notes de préparation intégrées.
                    </p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow hover-lift border border-transparent hover:border-surface-variant">
                    <div class="w-12 h-12 bg-tertiary-fixed rounded-lg flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">priority_high</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Priorités intelligentes</h3>
                    <p class="text-body-sm text-on-surface-variant leading-relaxed">
                        Définissez des priorités (Haute, Moyenne, Faible) pour savoir où concentrer vos efforts.
                    </p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow hover-lift border border-transparent hover:border-surface-variant">
                    <div class="w-12 h-12 bg-error-container rounded-lg flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-error" style="font-variation-settings: 'FILL' 1;">archive</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Archivage</h3>
                    <p class="text-body-sm text-on-surface-variant leading-relaxed">
                        Archivez les candidatures terminées sans les perdre. Restaurez-les en un clic si besoin.
                    </p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow hover-lift border border-transparent hover:border-surface-variant">
                    <div class="w-12 h-12 bg-primary-fixed rounded-lg flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">upload_file</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Fichiers joints</h3>
                    <p class="text-body-sm text-on-surface-variant leading-relaxed">
                        Joignez vos CV et lettres de motivation à chaque candidature pour les retrouver facilement.
                    </p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-6 soft-shadow hover-lift border border-transparent hover:border-surface-variant">
                    <div class="w-12 h-12 bg-secondary-fixed rounded-lg flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">edit_note</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Notes personnelles</h3>
                    <p class="text-body-sm text-on-surface-variant leading-relaxed">
                        Ajoutez des notes et détails importants pour chaque candidature. Gardez une trace de vos impressions et suivis.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="py-20 lg:py-24 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-3 gap-8 text-center">
                <div>
                    <p class="text-4xl lg:text-5xl font-bold text-primary">100%</p>
                    <p class="text-body-sm text-on-surface-variant mt-2">Gratuit</p>
                </div>
                <div>
                    <p class="text-4xl lg:text-5xl font-bold text-primary">+500</p>
                    <p class="text-body-sm text-on-surface-variant mt-2">Jeunes diplômés</p>
                </div>
                <div>
                    <p class="text-4xl lg:text-5xl font-bold text-primary">×2</p>
                    <p class="text-body-sm text-on-surface-variant mt-2">Candidatures mieux suivies</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-surface">
                    Prêt à organiser votre recherche d'emploi ?
                </h2>
                <p class="text-body-lg text-on-surface-variant mt-4">
                    Créez votre compte gratuitement et commencez à suivre vos candidatures dès aujourd'hui.
                </p>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-surface-tint text-on-primary px-8 py-3 rounded-lg text-body-sm font-medium transition-colors shadow-sm mt-8">
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        Créer un compte gratuit
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-outline-variant py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-primary rounded flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[14px]" style="font-variation-settings: 'FILL' 1;">work</span>
                </div>
                <span class="text-body-sm font-semibold text-primary">CandidatureTracker</span>
            </div>
            <p class="text-badge text-on-surface-variant">
                &copy; {{ date('Y') }} CandidatureTracker. Tous droits réservés.
            </p>
        </div>
    </footer>

</body>
</html>