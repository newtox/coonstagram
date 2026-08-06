<x-coonstagram-layout title="{{ __('coonstagram.edit_profile') }} – Coonstagram">
    <div class="max-w-2xl mx-auto space-y-6">
        <a href="{{ route('feed') }}" class="text-sm text-slate-500 hover:text-purple-400 transition">&larr; {{ __('coonstagram.back_to_feed') }}</a>

        <h1 class="text-xl font-bold text-purple-400">{{ __('coonstagram.edit_profile') }}</h1>

        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                class="text-sm text-green-400 bg-green-950/40 border border-green-900 rounded-lg px-4 py-2">
                {{ __('coonstagram.profile_updated') }}
            </div>
        @elseif (session('status') === 'avatar-removed')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                class="text-sm text-green-400 bg-green-950/40 border border-green-900 rounded-lg px-4 py-2">
                {{ __('coonstagram.avatar_removed') }}
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h2 class="font-semibold mb-4">{{ __('coonstagram.profile_info') }}</h2>

            <form id="delete-avatar-form" method="POST" action="{{ route('profile.avatar.destroy') }}" onsubmit="return confirm('{{ __('coonstagram.delete_avatar_confirm') }}')">
                @csrf
                @method('DELETE')
            </form>

            <form method="POST" action="{{ route('profile.update') }}" novalidate enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="flex items-center gap-4">
                    <x-avatar :user="$user" size="w-16 h-16 text-2xl" />
                    <div class="flex-1">
                        <label for="avatar" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.avatar') }}</label>
                        <input id="avatar" type="file" name="avatar" accept="image/*"
                            class="text-sm text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700">
                        @error('avatar')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @if ($user->avatar_path)
                        <button type="submit" form="delete-avatar-form" class="text-xs px-3 py-1.5 rounded-lg bg-red-900/40 text-red-400 hover:bg-red-900/70 transition">
                            {{ __('coonstagram.reset') }}
                        </button>
                    @endif
                </div>

                <div>
                    <label for="name" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.username') }}</label>
                    <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('username')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="display_name" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.display_name') }}</label>
                    <input id="display_name" type="text" name="display_name" value="{{ old('display_name', $user->display_name) }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('display_name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.title_tagline') }}</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $user->title) }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.bio') }}</label>
                    <textarea id="bio" name="bio" rows="3"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <p class="text-xs text-slate-500 mt-1">
                            {{ __('coonstagram.email_unverified') }}
                            <button form="send-verification" class="underline hover:text-purple-400">{{ __('coonstagram.resend_verification') }}</button>
                        </p>
                    @endif
                </div>

                <button type="submit" class="px-5 py-2 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold text-sm transition">
                    {{ __('coonstagram.save') }}
                </button>
            </form>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <form id="send-verification" method="POST" action="{{ route('verification.send') }}"></form>
            @endif
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h2 class="font-semibold mb-4">{{ __('coonstagram.language') }}</h2>

            <label for="locale" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.select_language') }}</label>
            <select id="locale" onchange="window.location.href = this.value"
                class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                <option value="{{ route('locale.switch', 'de') }}" {{ app()->getLocale() === 'de' ? 'selected' : '' }}>{{ __('coonstagram.german') }}</option>
                <option value="{{ route('locale.switch', 'en') }}" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>{{ __('coonstagram.english') }}</option>
            </select>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h2 class="font-semibold mb-4">{{ __('coonstagram.change_password') }}</h2>

            <form method="POST" action="{{ route('password.update') }}" novalidate class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.current_password') }}</label>
                    <input id="current_password" type="password" name="current_password" autocomplete="current-password"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('current_password', 'updatePassword')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.new_password') }}</label>
                    <input id="password" type="password" name="password" autocomplete="new-password"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('password', 'updatePassword')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.confirm_new_password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('password_confirmation', 'updatePassword')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-5 py-2 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold text-sm transition">
                    {{ __('coonstagram.save_password') }}
                </button>
            </form>
        </div>

        <div class="bg-slate-900 border border-red-900/50 rounded-xl p-6">
            <h2 class="font-semibold mb-2 text-red-400">{{ __('coonstagram.delete_account') }}</h2>
            <p class="text-sm text-slate-500 mb-4">{{ __('coonstagram.delete_account_warning') }}</p>

            <form method="POST" action="{{ route('profile.destroy') }}" novalidate onsubmit="return confirm('{{ __('coonstagram.delete_account_confirm') }}')" class="space-y-4">
                @csrf
                @method('DELETE')

                <div>
                    <label for="delete_password" class="block text-xs text-slate-400 mb-1">{{ __('coonstagram.password') }}</label>
                    <input id="delete_password" type="password" name="password" autocomplete="current-password"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('password', 'userDeletion')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-5 py-2 rounded-lg bg-red-900/40 text-red-400 hover:bg-red-900/70 font-semibold text-sm transition">
                    {{ __('coonstagram.delete_account') }}
                </button>
            </form>
        </div>
    </div>
</x-coonstagram-layout>