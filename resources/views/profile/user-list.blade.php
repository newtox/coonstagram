<x-coonstagram-layout title="{{ $listTitle }} – {{ $profileUser->display_name ?? $profileUser->name }}">
    <div class="max-w-2xl mx-auto space-y-6">
        <a href="{{ route('profile.show', $profileUser) }}" class="text-sm text-slate-500 hover:text-purple-400 transition">&larr; {{ $profileUser->display_name ?? $profileUser->name }}</a>

        <h1 class="text-xl font-bold text-purple-400">{{ $listTitle }}</h1>

        <div class="bg-slate-900 border border-slate-800 rounded-xl">
            @include('partials.user-list-items')
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>
</x-coonstagram-layout>