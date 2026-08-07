<x-coonstagram-layout title="{{ __('admin.admin_users') }} – Coonstagram">
    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('feed') }}" class="text-sm text-slate-500 hover:text-purple-400 transition">&larr; {{ __('ui.back_to_feed') }}</a>

        <h1 class="text-xl font-bold text-purple-400">{{ __('admin.admin_users') }}</h1>

        @if (session('status'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                class="text-sm text-green-400 bg-green-950/40 border border-green-900 rounded-lg px-4 py-2">
                {{ session('status') }}
            </div>
        @endif

        @error('admin')
            <div class="text-sm text-red-400 bg-red-950/40 border border-red-900 rounded-lg px-4 py-2">
                {{ $message }}
            </div>
        @enderror

        <div class="bg-slate-900 border border-slate-800 rounded-xl divide-y divide-slate-800">
            @foreach ($users as $targetUser)
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 py-3" x-data="{ confirmingDelete: false }">
                    <div class="flex items-center gap-3 min-w-0">
                        <x-avatar :user="$targetUser" size="w-10 h-10 text-sm" />
                        <div class="min-w-0">
                            <p class="font-semibold flex items-center gap-2 truncate">
                                {{ $targetUser->display_name ?? $targetUser->name }}
                                @if ($targetUser->is_admin)
                                    <span class="text-xs px-2 py-0.5 rounded bg-purple-600 text-white shrink-0">Admin</span>
                                @endif
                            </p>
                            <p class="text-xs text-slate-500 truncate">&commat;{{ $targetUser->username }}</p>
                        </div>
                    </div>

                    @if ($targetUser->id !== $user->id)
                        <div class="flex items-center gap-2 shrink-0">
                            <form method="POST" action="{{ route('admin.users.toggle-admin', $targetUser) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs px-3 py-1.5 rounded-lg transition {{ $targetUser->is_admin ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-purple-600 text-white hover:bg-purple-500' }}">
                                    {{ $targetUser->is_admin ? __('admin.revoke_admin') : __('admin.make_admin') }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.users.destroy', $targetUser) }}" x-ref="deleteForm" @submit.prevent="confirmingDelete = true">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-red-900/40 text-red-400 hover:bg-red-900/70 transition">
                                    {{ __('ui.delete') }}
                                </button>
                            </form>
                        </div>
                    @else
                        <span class="text-xs text-slate-600 shrink-0">{{ __('admin.thats_you') }}</span>
                    @endif

                    <x-confirm-modal show="confirmingDelete" onConfirm="$refs.deleteForm.submit()" :text="__('admin.delete_user_confirm')" />
                </div>
            @endforeach
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>
</x-coonstagram-layout>