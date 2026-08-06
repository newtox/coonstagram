<div id="post-{{ $post->id }}" x-data="{
        liked: {{ $post->isLikedBy($user) ? 'true' : 'false' }},
        likeCount: {{ $post->likes_count }},
        reporting: false,
        async toggleLike() {
            const res = await fetch('{{ route('posts.like', $post) }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            });
            const data = await res.json();
            this.liked = data.liked;
            this.likeCount = data.count;
        },
        async submitComment(event) {
            const form = event.target;
            const res = await fetch(form.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: new FormData(form),
            });
            const data = await res.json();
            document.getElementById('post-{{ $post->id }}').outerHTML = data.html;
        }
    }" class="bg-slate-900 border border-slate-800 rounded-xl p-5">
    <div class="flex items-center gap-3 mb-3">
        <a href="{{ route('profile.show', $post->user) }}">
            <x-avatar :user="$post->user" />
        </a>
        <div class="flex-1">
            <a href="{{ route('profile.show', $post->user) }}" class="font-semibold hover:text-purple-400 transition">{{ $post->user->display_name ?? $post->user->name }}</a>
            <p class="text-xs text-slate-500">&commat;{{ $post->user->username }} &middot; {{ $post->created_at->diffForHumans() }}</p>
        </div>

        <div class="flex items-center gap-2">
            @if ($post->user->id !== $user->id)
                <form method="POST" action="{{ route('users.follow', $post->user) }}">
                    @csrf
                    @php $isFollowingAuthor = in_array($post->user->id, $followingIds); @endphp
                    <button type="submit" class="text-xs px-3 py-1 rounded-lg transition {{ $isFollowingAuthor ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-purple-600 text-white hover:bg-purple-500' }}">
                        {{ $isFollowingAuthor ? __('coonstagram.following') : __('coonstagram.follow') }}
                    </button>
                </form>
            @endif

            @if ($post->user->id === $user->id || $user->isAdmin())
                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('{{ __('coonstagram.delete_confirm') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs px-3 py-1 rounded-lg bg-red-900/40 text-red-400 hover:bg-red-900/70 transition">
                        {{ __('coonstagram.delete') }}
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if ($post->image_path)
        <img src="{{ asset('storage/'.$post->image_path) }}" class="rounded-lg mb-3 w-full object-cover" alt="">
    @endif

    @if ($post->body)
        <p class="text-slate-200 mb-3">{{ $post->body }}</p>
    @endif

    <div class="flex items-center gap-6 text-sm text-slate-400 border-t border-slate-800 pt-3">
        <button type="button" @click="toggleLike()" class="flex items-center gap-1 transition" :class="liked ? 'text-pink-500' : 'hover:text-pink-400'">
            &hearts; <span x-text="likeCount"></span> {{ __('coonstagram.likes') }}
        </button>
        <span>&#128172; {{ $post->comments->count() }} {{ __('coonstagram.comments') }}</span>

        @if ($post->user->id !== $user->id)
            <div class="ml-auto">
                @if ($post->isReportedBy($user))
                    <span class="text-xs text-slate-600">{{ __('coonstagram.reported') }}</span>
                @else
                    <button type="button" @click="reporting = !reporting" class="text-xs text-slate-500 hover:text-red-400 transition">
                        {{ __('coonstagram.report') }}
                    </button>
                @endif
            </div>
        @endif
    </div>

    @if ($post->user->id !== $user->id && ! $post->isReportedBy($user))
        <form x-show="reporting" x-cloak method="POST" action="{{ route('posts.report', $post) }}" class="flex gap-2 mt-2">
            @csrf
            <input type="text" name="reason" placeholder="{{ __('coonstagram.report_reason_placeholder') }}"
                class="flex-1 bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-red-500">
            <button type="submit" class="px-2 py-1 rounded-lg bg-red-900/40 text-red-400 hover:bg-red-900/70 text-xs transition">
                {{ __('coonstagram.report_submit') }}
            </button>
        </form>
    @endif

    @foreach ($post->comments as $comment)
        <div class="mt-3 pl-4 border-l border-slate-800 text-sm">
            <p><span class="font-semibold">{{ $comment->user->display_name ?? $comment->user->name }}</span> {{ $comment->body }}</p>

            @foreach ($comment->replies as $reply)
                <p class="pl-4 mt-1 text-slate-400">
                    <span class="font-semibold">{{ $reply->user->display_name ?? $reply->user->name }}</span> {{ $reply->body }}
                </p>
            @endforeach

            <form @submit.prevent="submitComment($event)" method="POST" action="{{ route('comments.store', $post) }}" class="flex gap-2 mt-2 pl-4">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <input type="text" name="body" placeholder="{{ __('coonstagram.reply_placeholder') }}" required
                    class="flex-1 bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-purple-500">
                <button type="submit" class="px-2 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs transition">{{ __('coonstagram.reply') }}</button>
            </form>
        </div>
    @endforeach

    <form @submit.prevent="submitComment($event)" method="POST" action="{{ route('comments.store', $post) }}" class="flex gap-2 mt-3">
        @csrf
        <input type="text" name="body" placeholder="{{ __('coonstagram.write_comment') }}" required
            class="flex-1 bg-slate-950 border border-slate-800 rounded-lg px-3 py-1.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-purple-500">
        <button type="submit" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm transition">{{ __('coonstagram.send') }}</button>
    </form>
</div>