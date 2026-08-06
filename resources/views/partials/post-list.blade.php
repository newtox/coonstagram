@forelse ($posts as $post)
    @include('partials.post-card', ['post' => $post])
@empty
    <p class="text-slate-500">{{ $emptyText ?? __('feed.no_posts') }}</p>
@endforelse