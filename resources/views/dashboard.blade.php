<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <p class="text-lg">Bienvenue, {{ Auth::user()->name }} !</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Accédez à votre tableau de bord de candidatures.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                        <a href="{{ route('candidatures.index') }}" class="bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-lg p-4 border border-blue-200 dark:border-blue-800 transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">dashboard</span>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">Mes candidatures</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Gérer mes candidatures</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('candidatures.create') }}" class="bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-lg p-4 border border-green-200 dark:border-green-800 transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-green-600 dark:text-green-400">add_circle</span>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">Nouvelle candidature</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Ajouter une candidature</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('archives.index') }}" class="bg-gray-50 dark:bg-gray-900/30 hover:bg-gray-100 dark:hover:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-800 transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">archive</span>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">Archives</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Voir les archives</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>