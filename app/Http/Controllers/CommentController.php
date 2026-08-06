<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'parent_id' => $data['parent_id'] ?? null,
            'body' => $data['body'],
        ]);

        if ($request->wantsJson()) {
            $post->load(['user', 'comments.user', 'comments.replies.user'])->loadCount('likes');
            $followingIds = $request->user()->following()->pluck('users.id')->all();

            return response()->json([
                'html' => view('partials.post-card', [
                    'post' => $post,
                    'user' => $request->user(),
                    'followingIds' => $followingIds,
                ])->render(),
            ]);
        }

        return back();
    }
}
