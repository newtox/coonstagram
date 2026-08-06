<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Coonstagram' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white min-h-screen">
    <nav class="flex items-center justify-between px-8 py-4 border-b border-slate-800">
        <a href="{{ route('feed') }}" class="flex items-center gap-2">
            <span class="text-xl">🦝</span>
            <span class="text-lg font-bold text-purple-400">Coonstagram</span>
        </a>

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false" class="block">
                    <x-avatar :user="auth()->user()" size="w-8 h-8 text-sm" />
                </button>

                <div x-show="open" x-transition x-cloak
                    class="absolute right-0 mt-2 w-48 bg-slate-900 border border-slate-800 rounded-lg shadow-lg py-1 z-10">
                    <a href="{{ route('profile.show', auth()->user()) }}" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-800 transition">
                        Mein Profil
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-800 transition">
                        Profil bearbeiten
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-purple-400 hover:bg-slate-800 transition">
                            {{ __('coonstagram.admin_users') }}
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-sm text-slate-300 hover:bg-slate-800 transition">
                            {{ __('coonstagram.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-8 py-8">
        {{ $slot }}
    </main>

    <footer class="text-center text-xs text-slate-600 py-6">
        Coonstagram — South Park Tablet Edition
    </footer>
</body>
</html>