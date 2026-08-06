<x-coonstagram-layout title="Feed – Coonstagram">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <h1 class="text-xl font-bold text-purple-400 mb-4">{{ __('coonstagram.feed') }}</h1>

            @if (session('status'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                    class="text-green-400 text-sm mb-3 bg-green-950/40 border border-green-900 rounded-lg px-4 py-2">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex gap-2 mb-4">
                <a href="{{ route('feed', ['filter' => 'for-you']) }}"
                    class="px-4 py-1.5 rounded-lg text-sm font-semibold transition {{ $filter === 'for-you' ? 'bg-purple-600 text-white' : 'bg-slate-900 text-slate-400 hover:text-white' }}">
                    {{ __('coonstagram.for_you') }}
                </a>
                <a href="{{ route('feed', ['filter' => 'following']) }}"
                    class="px-4 py-1.5 rounded-lg text-sm font-semibold transition {{ $filter === 'following' ? 'bg-purple-600 text-white' : 'bg-slate-900 text-slate-400 hover:text-white' }}">
                    {{ __('coonstagram.following_tab') }}
                </a>
            </div>

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="bg-slate-900 border border-slate-800 rounded-xl p-5 mb-4">
                @csrf

                @if ($user->isAdmin())
                    <select name="post_as" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-sm text-white mb-3 focus:outline-none focus:border-purple-500">
                        <option value="">{{ __('coonstagram.post_as_yourself') }}</option>
                        @foreach ($postableUsers as $character)
                            <option value="{{ $character->id }}">{{ $character->display_name ?? $character->name }}</option>
                        @endforeach
                    </select>
                @endif

                <textarea name="body" rows="3" placeholder="{{ __('coonstagram.whats_new') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-white placeholder-slate-500 focus:outline-none focus:border-purple-500">{{ old('body') }}</textarea>

                @error('body')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div class="flex items-center justify-between mt-3">
                    <input type="file" name="image" accept="image/*"
                        class="text-sm text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700">
                    <button type="submit" class="px-5 py-2 rounded-lg bg-purple-600 hover:bg-purple-500 font-semibold text-sm transition">
                        {{ __('coonstagram.post') }}
                    </button>
                </div>
            </form>

            <div class="space-y-4">
                @forelse ($posts as $post)
                    @include('partials.post-card', ['post' => $post])
                @empty
                    <p class="text-slate-500">
                        {{ $filter === 'following' ? __('coonstagram.no_posts_following') : __('coonstagram.no_posts') }}
                    </p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>

        <div>
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-5 text-center">
                <x-avatar :user="$user" size="w-16 h-16 text-2xl mx-auto mb-3" />
                <p class="font-bold">{{ $user->display_name ?? $user->name }}</p>
                <p class="text-purple-400 text-sm">&commat;{{ $user->username }}</p>
                <p class="text-slate-500 text-xs mt-2">{{ $user->title }}</p>

                <div class="flex justify-around mt-4 pt-4 border-t border-slate-800">
                    <div>
                        <p class="font-bold">{{ $user->posts()->count() }}</p>
                        <p class="text-xs text-slate-500">{{ __('coonstagram.posts_label') }}</p>
                    </div>
                    <div>
                        <p class="font-bold">{{ $user->followersCount() }}</p>
                        <p class="text-xs text-slate-500">{{ __('coonstagram.followers_label') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-5 mt-4">
                <p class="text-xs font-bold text-slate-500 mb-3 tracking-wide">{{ __('coonstagram.latest_followers') }}</p>
                <div class="space-y-3">
                    @forelse ($latestFollowers as $follower)
                        <a href="{{ route('profile.show', $follower) }}" class="flex items-center gap-2 hover:text-purple-400 transition">
                            <x-avatar :user="$follower" size="w-8 h-8 text-sm" />
                            <span class="text-sm">{{ $follower->display_name ?? $follower->name }}</span>
                        </a>
                    @empty
                        <p class="text-sm text-slate-600">{{ __('coonstagram.no_followers') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-coonstagram-layout>