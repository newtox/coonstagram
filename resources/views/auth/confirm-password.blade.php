<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="flex items-center gap-2 mb-8">
            <span class="text-3xl">🦝</span>
            <span class="text-2xl font-bold text-purple-400">Coonstagram</span>
        </div>

        <div class="w-full max-w-sm bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-lg font-bold mb-1">{{ __('coonstagram.confirm_password_title') }}</h1>
            <p class="text-sm text-slate-500 mb-6">{{ __('coonstagram.confirm_password_text') }}</p>

            <form method="POST" action="{{ route('password.confirm') }}" novalidate class="space-y-4">
                @csrf

                <div>
                    <label for="password" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" autofocus
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-2.5 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold transition">
                    {{ __('coonstagram.confirm') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>