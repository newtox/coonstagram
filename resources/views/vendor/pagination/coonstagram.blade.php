@if ($paginator->hasPages())
    <div class="flex items-center justify-between flex-wrap gap-4">
        <p class="text-sm text-slate-500">
            {{ __('pagination.showing', ['first' => $paginator->firstItem(), 'last' => $paginator->lastItem(), 'total' => $paginator->total()]) }}
        </p>

        <nav role="navigation" aria-label="Pagination">
            <div class="inline-flex rounded-xl border border-slate-800 overflow-hidden divide-x divide-slate-800">
                @if ($paginator->onFirstPage())
                    <span class="w-11 h-11 flex items-center justify-center text-base text-slate-600 cursor-not-allowed">&lsaquo;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-11 h-11 flex items-center justify-center text-base bg-slate-900 text-slate-300 hover:bg-slate-800 transition">&lsaquo;</a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="w-11 h-11 flex items-center justify-center text-base text-slate-600 bg-slate-900">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="w-11 h-11 flex items-center justify-center text-base bg-purple-600 text-white font-semibold">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="w-11 h-11 flex items-center justify-center text-base bg-slate-900 text-slate-300 hover:bg-slate-800 transition">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-11 h-11 flex items-center justify-center text-base bg-slate-900 text-slate-300 hover:bg-slate-800 transition">&rsaquo;</a>
                @else
                    <span class="w-11 h-11 flex items-center justify-center text-base text-slate-600 cursor-not-allowed">&rsaquo;</span>
                @endif
            </div>
        </nav>
    </div>
@endif