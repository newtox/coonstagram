@props(['show', 'onConfirm', 'text' => null])

<div x-show="{{ $show }}" x-cloak
    class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 px-4"
    @click.self="{{ $show }} = false" @keydown.escape.window="{{ $show }} = false">
    <div x-show="{{ $show }}" x-transition class="bg-slate-900 border border-slate-800 rounded-xl w-full max-w-sm p-6">
        <h3 class="font-bold mb-2">{{ __('ui.confirm_title') }}</h3>
        <div class="flex justify-end gap-2">
            <button type="button" @click="{{ $show }} = false" class="px-4 py-2 rounded-lg bg-slate-800 text-slate-300 hover:bg-slate-700 text-sm transition">
                {{ __('ui.cancel') }}
            </button>
            <button type="button" @click="{{ $onConfirm }}; {{ $show }} = false" class="px-4 py-2 rounded-lg bg-red-900/40 text-red-400 hover:bg-red-900/70 text-sm font-semibold transition">
                {{ __('ui.confirm_delete') }}
            </button>
        </div>
    </div>
</div>