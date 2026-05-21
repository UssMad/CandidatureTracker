<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'CandidatureTracker'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .soft-shadow { box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05); }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -2px rgb(0 0 0 / 0.05); }
    </style>

    @stack('styles')
</head>
<body x-data="{ sidebarOpen: false }" class="font-inter bg-background text-on-surface min-h-screen flex flex-col md:flex-row antialiased">

    {{-- Mobile Sidebar Overlay --}}
    <template x-teleport="body">
        <div x-show="sidebarOpen" x-cloak
             class="fixed inset-0 z-50 md:hidden"
             x-transition:enter="transition-opacity ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-black/40" @click="sidebarOpen = false"></div>
            <div class="absolute left-0 top-0 bottom-0 w-64 bg-surface-container-lowest shadow-xl"
                 @click.away="sidebarOpen = false"
                 x-transition:enter="transition-transform ease-out duration-200"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition-transform ease-in duration-150"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full">
                <div class="flex flex-col h-full py-stack-lg">
                    <div class="px-6 mb-8">
                        <h1 class="text-headline-md font-semibold text-primary">CandidatureTracker</h1>
                        <p class="text-body-sm text-on-surface-variant mt-1">Tableau de bord de carrière</p>
                    </div>
                    <nav class="flex-1 flex flex-col gap-1 px-4">
                        <x-sidebar-link :href="route('candidatures.index')" :active="request()->routeIs('candidatures.*')" icon="dashboard">
                            Tableau de bord
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('archives.index')" :active="request()->routeIs('archives.*')" icon="archive">
                            Archives
                        </x-sidebar-link>
                    </nav>
                    <div class="px-4 mt-auto border-t border-outline-variant pt-4 flex flex-col gap-1">
                        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" icon="settings">
                            Paramètres
                        </x-sidebar-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors duration-200 text-body-lg">
                                <span class="material-symbols-outlined">logout</span>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

    {{-- SideNavBar (Desktop) --}}
    <nav class="hidden md:flex flex-col h-screen w-64 fixed left-0 top-0 bg-surface-container-lowest py-stack-lg border-r border-outline-variant shadow-sm z-50">
        <div class="px-6 mb-8">
            <h1 class="text-headline-md font-semibold text-primary">CandidatureTracker</h1>
            <p class="text-body-sm text-on-surface-variant mt-1">Tableau de bord de carrière</p>
        </div>
        <div class="flex-1 flex flex-col gap-1 px-4">
            <x-sidebar-link :href="route('candidatures.index')" :active="request()->routeIs('candidatures.*') && !request()->routeIs('archives.*')" icon="dashboard">
                Tableau de bord
            </x-sidebar-link>
            <x-sidebar-link :href="route('archives.index')" :active="request()->routeIs('archives.*')" icon="archive">
                Archives
            </x-sidebar-link>
        </div>
        <div class="px-4 mt-auto border-t border-outline-variant pt-4 flex flex-col gap-1">
            <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" icon="settings">
                Paramètres
            </x-sidebar-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors duration-200 text-body-lg">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </nav>

    {{-- Main Content Area --}}
    <main class="flex-1 md:ml-64 flex flex-col w-full min-h-screen">
        {{-- Mobile TopAppBar --}}
        <header class="md:hidden w-full h-16 sticky top-0 z-40 bg-surface/80 backdrop-blur-md shadow-sm border-b border-outline-variant">
            <div class="flex items-center justify-between px-4 w-full h-full max-w-container-max mx-auto">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="text-on-surface-variant">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h1 class="text-headline-md font-semibold text-primary">CandidatureTracker</h1>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.edit') }}" class="text-on-surface-variant hover:text-primary transition-all rounded-full p-1">
                        <span class="material-symbols-outlined">account_circle</span>
                    </a>
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="px-gutter md:px-8 pt-stack-lg max-w-container-max mx-auto w-full">
                <div class="bg-secondary-container text-on-secondary-container px-4 py-3 rounded-lg flex items-center gap-2 text-body-sm" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    <span class="flex-1">{{ session('success') }}</span>
                    <button @click="show = false" class="text-on-secondary-container/60 hover:text-on-secondary-container">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="px-gutter md:px-8 pt-stack-lg max-w-container-max mx-auto w-full">
                <div class="bg-error-container text-on-error-container px-4 py-3 rounded-lg flex items-center gap-2 text-body-sm" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <span class="material-symbols-outlined text-[18px]">error</span>
                    <span class="flex-1">{{ session('error') }}</span>
                    <button @click="show = false" class="text-on-error-container/60 hover:text-on-error-container">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            </div>
        @endif

        {{-- Page Content --}}
        <div class="px-gutter md:px-8 py-stack-lg max-w-container-max mx-auto w-full flex-1">
            @yield('content')
        </div>
    </main>

    {{-- BottomNavBar (Mobile Only) --}}
    <nav class="md:hidden fixed bottom-0 left-0 w-full bg-surface-container-lowest border-t border-outline-variant shadow-[0_-2px_10px_rgba(0,0,0,0.05)] z-50 flex justify-around items-center py-2 px-4">
        <a href="{{ route('candidatures.index') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('candidatures.*') && !request()->routeIs('archives.*') ? 'text-primary' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('candidatures.*') && !request()->routeIs('archives.*')) style="font-variation-settings: 'FILL' 1;" @endif>dashboard</span>
            <span class="text-badge mt-1">Tableau</span>
        </a>
        <a href="{{ route('archives.index') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('archives.*') ? 'text-primary' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('archives.*')) style="font-variation-settings: 'FILL' 1;" @endif>archive</span>
            <span class="text-badge mt-1">Archives</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('profile.edit') ? 'text-primary' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('profile.edit')) style="font-variation-settings: 'FILL' 1;" @endif>account_circle</span>
            <span class="text-badge mt-1">Profil</span>
        </a>
    </nav>

    @stack('scripts')
</body>
</html>