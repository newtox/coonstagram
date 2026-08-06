<x-coonstagram-layout title="{{ $profileUser->display_name ?? $profileUser->name }} – Coonstagram">
    <div x-data="{
            modalOpen: false,
            modalTitle: '',
            modalHtml: '',
            async openList(url, title) {
                this.modalTitle = title;
                this.modalHtml = '<p class=&quot;text-slate-500 text-sm px-5 py-4&quot;>…</p>';
                this.modalOpen = true;
                const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                const data = await res.json();
                this.modalHtml = data.html;
            }
        }">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <a href="{{ route('feed') }}" class="text-sm text-slate-500 hover:text-purple-400 transition">&larr; {{ __('ui.back_to_feed') }}</a>

                <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mt-4 mb-6">
                    <div class="flex items-center gap-4">
                        <x-avatar :user="$profileUser" size="w-16 h-16 text-2xl" />
                        <div class="flex-1">
                            <p class="text-lg font-bold">{{ $profileUser->display_name ?? $profileUser->name }}</p>
                            <p class="text-purple-400 text-sm">&commat;{{ $profileUser->username }}</p>
                            @if ($profileUser->title)
                                <p class="text-slate-500 text-xs mt-1">{{ $profileUser->title }}</p>
                            @endif
                        </div>

                        @if ($profileUser->id !== $user->id)
                            <form method="POST" action="{{ route('users.follow', $profileUser) }}">
                                @csrf
                                <button type="submit" class="text-sm px-4 py-2 rounded-lg transition {{ $isFollowing ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-purple-600 text-white hover:bg-purple-500' }}">
                                    {{ $isFollowing ? __('ui.following') : __('ui.follow') }}
                                </button>
                            </form>
                        @endif
                    </div>

                    @if ($profileUser->bio)
                        <p class="text-slate-300 text-sm mt-4">{{ $profileUser->bio }}</p>
                    @endif

                    <div class="flex gap-8 mt-4 pt-4 border-t border-slate-800">
                        <div>
                            <span class="font-bold">{{ $profileUser->posts()->count() }}</span>
                            <span class="text-xs text-slate-500">{{ __('feed.posts_label') }}</span>
                        </div>
                        <button type="button" @click="openList('{{ route('profile.followers', $profileUser) }}', '{{ __('profile.followers_label') }}')" class="hover:text-purple-400 transition text-left">
                            <span class="font-bold">{{ $profileUser->followersCount() }}</span>
                            <span class="text-xs text-slate-500">{{ __('profile.followers_label') }}</span>
                        </button>
                        <button type="button" @click="openList('{{ route('profile.following', $profileUser) }}', '{{ __('profile.following_label') }}')" class="hover:text-purple-400 transition text-left">
                            <span class="font-bold">{{ $profileUser->following()->count() }}</span>
                            <span class="text-xs text-slate-500">{{ __('profile.following_label') }}</span>
                        </button>
                    </div>
                </div>

                <div class="space-y-4" id="profile-posts-container">
                    @include('partials.post-list', [
                        'posts' => $posts,
                        'user' => $user,
                        'followingIds' => $followingIds,
                        'emptyText' => __('feed.no_posts'),
                    ])
                </div>

                @if ($posts->hasMorePages())
                    <div class="mt-6 text-center" x-data="{
                            nextUrl: '{{ $posts->nextPageUrl() }}',
                            loading: false,
                            async loadMore() {
                                this.loading = true;
                                const res = await fetch(this.nextUrl, { headers: { 'Accept': 'application/json' } });
                                const data = await res.json();
                                document.getElementById('profile-posts-container').insertAdjacentHTML('beforeend', data.html);
                                this.nextUrl = data.nextPageUrl;
                                this.loading = false;
                            }
                        }">
                        <button type="button" @click="loadMore()" x-show="nextUrl" :disabled="loading"
                            class="px-5 py-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-300 hover:bg-slate-800 transition disabled:opacity-50">
                            <span x-show="!loading">{{ __('feed.load_more') }}</span>
                            <span x-show="loading" x-cloak>{{ __('feed.loading') }}</span>
                        </button>
                    </div>
                @endif
            </div>

            <div>
                <div class="bg-slate-900 border border-slate-800 rounded-xl p-5 mt-4">
                    <p class="text-xs font-bold text-slate-500 mb-3 tracking-wide">{{ __('profile.latest_followers') }}</p>
                    <div class="space-y-3">
                        @forelse ($latestFollowers as $follower)
                            <a href="{{ route('profile.show', $follower) }}" class="flex items-center gap-2 hover:text-purple-400 transition">
                                <x-avatar :user="$follower" size="w-8 h-8 text-sm" />
                                <span class="text-sm">{{ $follower->display_name ?? $follower->name }}</span>
                            </a>
                        @empty
                            <p class="text-sm text-slate-600">{{ __('profile.no_followers') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div x-show="modalOpen" x-cloak
            class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 px-4"
            @click.self="modalOpen = false" @keydown.escape.window="modalOpen = false">
            <div x-show="modalOpen" x-transition class="bg-slate-900 border border-slate-800 rounded-xl w-full max-w-md max-h-[80vh] flex flex-col">
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-800">
                    <h2 class="font-bold" x-text="modalTitle"></h2>
                    <button type="button" @click="modalOpen = false" class="text-slate-500 hover:text-white transition text-xl leading-none">&times;</button>
                </div>
                <div class="overflow-y-auto" x-html="modalHtml"></div>
            </div>
        </div>
    </div>
</x-coonstagram-layout>