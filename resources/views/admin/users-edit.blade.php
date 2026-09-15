<x-coonstagram-layout title="{{ __('admin.edit_user') }} – Coonstagram">
    <div class="max-w-2xl mx-auto space-y-6">
        <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-500 hover:text-purple-400 transition">&larr; {{ __('admin.admin_users') }}</a>

        <h1 class="text-xl font-bold text-purple-400">{{ __('admin.edit_user') }}</h1>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <form method="POST" action="{{ route('admin.users.update', $targetUser) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="flex items-center gap-4">
                    <x-avatar :user="$targetUser" size="w-16 h-16 text-2xl" />
                    <div class="flex-1 min-w-0">
                        <label for="avatar" class="block text-xs text-slate-400 mb-1">{{ __('profile.avatar') }}</label>
                        <input id="avatar" type="file" name="avatar" accept="image/*"
                            class="w-full text-sm text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700">
                        @error('avatar')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-xs text-slate-400 mb-1">{{ __('profile.name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $targetUser->name) }}" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block text-xs text-slate-400 mb-1">{{ __('profile.username') }}</label>
                    <input id="username" type="text" name="username" value="{{ old('username', $targetUser->username) }}" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('username')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="display_name" class="block text-xs text-slate-400 mb-1">{{ __('profile.display_name') }}</label>
                    <input id="display_name" type="text" name="display_name" value="{{ old('display_name', $targetUser->display_name) }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('display_name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block text-xs text-slate-400 mb-1">{{ __('profile.title_tagline') }}</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $targetUser->title) }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-xs text-slate-400 mb-1">{{ __('profile.bio') }}</label>
                    <textarea id="bio" name="bio" rows="3"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">{{ old('bio', $targetUser->bio) }}</textarea>
                    @error('bio')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs text-slate-400 mb-1">{{ __('profile.email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $targetUser->email) }}" required
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 border-t border-slate-800 space-y-4">
                    <div>
                        <label for="password" class="block text-xs text-slate-400 mb-1">{{ __('admin.new_password_optional') }}</label>
                        <input id="password" type="password" name="password" autocomplete="new-password"
                            class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs text-slate-400 mb-1">{{ __('admin.confirm_new_password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password"
                            class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-purple-500">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 rounded-lg bg-purple-600 text-white hover:bg-purple-500 transition text-sm font-semibold">
                        {{ __('profile.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-coonstagram-layout>