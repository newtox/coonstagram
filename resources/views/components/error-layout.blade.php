@props(['code', 'title', 'text'])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $code }} – Coonstagram</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 text-center">
        <div class="flex items-center gap-2 mb-8">
            <span class="text-3xl">🦝</span>
            <span class="text-2xl font-bold text-purple-400">Coonstagram</span>
        </div>

        <p class="text-6xl font-bold text-purple-400 mb-2">{{ $code }}</p>
        <h1 class="text-lg font-semibold mb-2">{{ $title }}</h1>
        <p class="text-sm text-slate-500 max-w-sm mb-8">{{ $text }}</p>

        <a href="{{ auth()->check() ? route('feed') : route('login') }}"
            class="px-6 py-3 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold transition">
            {{ auth()->check() ? __('ui.back_to_feed') : __('auth_pages.login') }}
        </a>
    </div>
</body>
</html>