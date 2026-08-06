<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="flex items-center gap-2 mb-8">
            <span class="text-3xl">🦝</span>
            <span class="text-2xl font-bold text-purple-400">Coonstagram</span>
        </div>

        <div class="w-full max-w-sm bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-lg font-bold mb-1">{{ __('coonstagram.register') }}</h1>
            <p class="text-sm text-slate-500 mb-6">{{ __('coonstagram.register_welcome') }}</p>

            <form method="POST" action="{{ route('register') }}" novalidate class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.password_confirmation') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('password_confirmation')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-2.5 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold transition">
                    {{ __('coonstagram.register') }}
                </button>

                <div class="text-center text-xs text-slate-500 pt-2">
                    <a href="{{ route('login') }}" class="hover:text-purple-400 transition">{{ __('coonstagram.already_registered') }}</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>