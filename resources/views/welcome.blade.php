<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coonstagram</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="flex items-center gap-2 mb-6">
            <span class="text-3xl">🦝</span>
            <h1 class="text-3xl font-bold text-purple-400">Coonstagram</h1>
        </div>
        <p class="text-slate-400 text-center max-w-md mb-8">
            Der South-Park-Tablet-Feed für Coon and Friends. Melde dich an, um zu sehen, was Jimmy, Kyle &amp; Co. gerade treiben.
        </p>
        <div class="flex gap-4">
            @auth
                <a href="{{ route('feed') }}" class="px-6 py-3 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold transition">Zum Feed</a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-3 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold transition">Einloggen</a>
                <a href="{{ route('register') }}" class="px-6 py-3 rounded-lg border border-slate-700 hover:border-purple-500 font-semibold transition">Registrieren</a>
            @endauth
        </div>
    </div>
</body>
</html>