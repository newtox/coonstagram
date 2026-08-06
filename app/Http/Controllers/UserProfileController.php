<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(Request $request, User $user)
    {
        $authUser = $request->user();
        $followingIds = $authUser->following()->pluck('users.id')->all();

        $posts = $user->posts()
            ->with(['user', 'comments.user', 'comments.replies.user'])
            ->withCount('likes')
            ->latest()
            ->paginate(10);

        $isFollowing = in_array($user->id, $followingIds);
        $latestFollowers = $user->followers()->latest('follows.created_at')->take(2)->get();

        return view('profile.show', [
            'profileUser' => $user,
            'user' => $authUser,
            'posts' => $posts,
            'isFollowing' => $isFollowing,
            'followingIds' => $followingIds,
            'latestFollowers' => $latestFollowers,
        ]);
    }

    public function followers(Request $request, User $user)
    {
        $authUser = $request->user();
        $followingIds = $authUser->following()->pluck('users.id')->all();

        $users = $user->followers()->orderBy('display_name')->paginate(50);

        if ($request->wantsJson()) {
            return response()->json([
                'html' => view('partials.user-list-items', [
                    'users' => $users,
                    'user' => $authUser,
                    'followingIds' => $followingIds,
                ])->render(),
            ]);
        }

        return view('profile.user-list', [
            'profileUser' => $user,
            'user' => $authUser,
            'users' => $users,
            'followingIds' => $followingIds,
            'listTitle' => __('coonstagram.followers_label'),
        ]);
    }

    public function following(Request $request, User $user)
    {
        $authUser = $request->user();
        $followingIds = $authUser->following()->pluck('users.id')->all();

        $users = $user->following()->orderBy('display_name')->paginate(50);

        if ($request->wantsJson()) {
            return response()->json([
                'html' => view('partials.user-list-items', [
                    'users' => $users,
                    'user' => $authUser,
                    'followingIds' => $followingIds,
                ])->render(),
            ]);
        }

        return view('profile.user-list', [
            'profileUser' => $user,
            'user' => $authUser,
            'users' => $users,
            'followingIds' => $followingIds,
            'listTitle' => __('coonstagram.following_label'),
        ]);
    }
}
