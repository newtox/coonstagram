<div class="divide-y divide-slate-800">
    @forelse ($users as $listedUser)
        <div class="flex items-center justify-between px-5 py-3">
            <a href="{{ route('profile.show', $listedUser) }}" class="flex items-center gap-3 hover:text-purple-400 transition">
                <x-avatar :user="$listedUser" size="w-10 h-10 text-sm" />
                <div>
                    <p class="font-semibold">{{ $listedUser->display_name ?? $listedUser->name }}</p>
                    <p class="text-xs text-slate-500">&commat;{{ $listedUser->username }}</p>
                </div>
            </a>

            @if ($listedUser->id !== $user->id)
                <form method="POST" action="{{ route('users.follow', $listedUser) }}">
                    @csrf
                    @php $isFollowingListed = in_array($listedUser->id, $followingIds); @endphp
                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg transition {{ $isFollowingListed ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-purple-600 text-white hover:bg-purple-500' }}">
                        {{ $isFollowingListed ? __('coonstagram.following') : __('coonstagram.follow') }}
                    </button>
                </form>
            @endif
        </div>
    @empty
        <p class="px-5 py-4 text-sm text-slate-500">{{ __('coonstagram.no_users_here') }}</p>
    @endforelse
</div>