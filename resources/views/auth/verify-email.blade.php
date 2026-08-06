<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="flex items-center gap-2 mb-8">
            <span class="text-3xl">🦝</span>
            <span class="text-2xl font-bold text-purple-400">Coonstagram</span>
        </div>

        <div class="w-full max-w-sm bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-lg font-bold mb-1">{{ __('auth_pages.verify_email_title') }}</h1>
            <p class="text-sm text-slate-500 mb-6">{{ __('auth_pages.verify_email_text') }}</p>

            @if (session('status') === 'verification-link-sent')
                <div class="mb-4 text-sm text-green-400">{{ __('auth_pages.verify_email_resent') }}</div>
            @endif

            <div class="flex items-center justify-between gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="text-sm px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold transition">
                        {{ __('auth_pages.resend_email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-slate-400 hover:text-white transition">
                        {{ __('ui.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>