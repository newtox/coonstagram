<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $filter = $request->query('filter', 'for-you');
        $followingIds = $user->following()->pluck('users.id')->all();

        $query = Post::with(['user', 'comments.user', 'comments.replies.user'])
            ->withCount('likes')
            ->latest();

        if ($filter === 'following') {
            $query->whereIn('user_id', $followingIds);
        }

        $posts = $query->paginate(10)->withQueryString();

        $latestFollowers = $user->followers()->latest('follows.created_at')->take(2)->get();

        $postableUsers = $user->isAdmin()
            ? User::where('id', '!=', $user->id, 'and')->orderBy('display_name')->get()
            : collect();

        return view('feed.index', [
            'posts' => $posts,
            'user' => $user,
            'latestFollowers' => $latestFollowers,
            'filter' => $filter,
            'followingIds' => $followingIds,
            'postableUsers' => $postableUsers,
        ]);
    }
}
