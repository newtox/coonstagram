@props(['user', 'size' => 'w-10 h-10 text-base'])

@if ($user->avatarUrl())
    <img src="{{ $user->avatarUrl() }}" alt="{{ $user->display_name ?? $user->name }}" class="{{ $size }} shrink-0 rounded-full object-cover">
@else
    <div class="{{ $size }} shrink-0 rounded-full bg-purple-600 flex items-center justify-center font-bold">
        {{ strtoupper(substr($user->display_name ?? $user->name, 0, 1)) }}
    </div>
@endif