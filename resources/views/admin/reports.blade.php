<x-coonstagram-layout title="{{ __('admin.admin_reports') }} – Coonstagram">
    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('feed') }}" class="text-sm text-slate-500 hover:text-purple-400 transition">&larr; {{ __('ui.back_to_feed') }}</a>

        <h1 class="text-xl font-bold text-purple-400">{{ __('admin.admin_reports') }}</h1>

        @if (session('status'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                class="text-sm text-green-400 bg-green-950/40 border border-green-900 rounded-lg px-4 py-2">
                {{ session('status') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($reportedPosts as $post)
                <div class="bg-slate-900 border border-slate-800 rounded-xl p-5" x-data="{ confirmingDelete: false }">
                    <div class="flex items-center gap-3 mb-3">
                        <x-avatar :user="$post->user" />
                        <div class="flex-1">
                            <p class="font-semibold">{{ $post->user->display_name ?? $post->user->name }}</p>
                            <p class="text-xs text-slate-500">&commat;{{ $post->user->username }} &middot; {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded bg-red-900/40 text-red-400">
                            {{ $post->reports_count }} {{ __('admin.reports_count_label') }}
                        </span>
                    </div>

                    @if ($post->image_path)
                        <img src="{{ asset('storage/'.$post->image_path) }}" class="rounded-lg mb-3 w-full object-cover" alt="">
                    @endif

                    @if ($post->body)
                        <p class="text-slate-200 mb-3">{{ $post->body }}</p>
                    @endif

                    <div class="border-t border-slate-800 pt-3 space-y-2">
                        <p class="text-xs font-bold text-slate-500 tracking-wide">{{ __('admin.report_reasons') }}</p>
                        @foreach ($post->reports as $report)
                            <p class="text-sm text-slate-400">
                                <span class="font-semibold text-slate-300">{{ $report->user->display_name ?? $report->user->name }}:</span>
                                {{ $report->reason ?: __('admin.no_reason_given') }}
                            </p>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-2 mt-4">
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" x-ref="deleteForm" @submit.prevent="confirmingDelete = true">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-red-900/40 text-red-400 hover:bg-red-900/70 transition">
                                {{ __('admin.delete_post') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reports.dismiss', $post) }}">
                            @csrf
                            <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-slate-800 text-slate-300 hover:bg-slate-700 transition">
                                {{ __('admin.dismiss_reports') }}
                            </button>
                        </form>
                    </div>

                    <x-confirm-modal show="confirmingDelete" onConfirm="$refs.deleteForm.submit()" :text="__('feed.delete_confirm')" />
                </div>
            @empty
                <p class="text-slate-500">{{ __('admin.no_reports') }}</p>
            @endforelse
        </div>

        <div>
            {{ $reportedPosts->links() }}
        </div>
    </div>
</x-coonstagram-layout>