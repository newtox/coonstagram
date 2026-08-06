@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination">
        <div class="inline-flex rounded-lg border border-slate-800 overflow-hidden divide-x divide-slate-800">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-sm text-slate-600 cursor-not-allowed">&lsaquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-sm bg-slate-900 text-slate-300 hover:bg-slate-800 transition">&lsaquo;</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 text-sm text-slate-600 bg-slate-900">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3.5 py-2 text-sm bg-purple-600 text-white font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3.5 py-2 text-sm bg-slate-900 text-slate-300 hover:bg-slate-800 transition">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-sm bg-slate-900 text-slate-300 hover:bg-slate-800 transition">&rsaquo;</a>
            @else
                <span class="px-3 py-2 text-sm text-slate-600 cursor-not-allowed">&rsaquo;</span>
            @endif
        </div>
    </nav>
@endif