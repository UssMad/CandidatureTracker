<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter antialiased bg-background text-on-surface min-h-screen flex flex-col">
    <div class="flex-1 flex flex-col sm:justify-center items-center px-4 py-8">
        <div class="w-full max-w-sm">
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center justify-center gap-3">
                    <x-application-logo class="w-10 h-10 text-primary" />
                    <span class="text-headline-md font-semibold text-primary">{{ config('app.name', 'CandidatureTracker') }}</span>
                </a>
                <p class="text-body-sm text-on-surface-variant mt-2">Tableau de bord de carrière</p>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
