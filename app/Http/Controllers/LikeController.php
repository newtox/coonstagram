<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $like = $post->likes()->where('user_id', $request->user()->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create(['user_id' => $request->user()->id]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'liked' => $post->isLikedBy($request->user()),
                'count' => $post->likes()->count(),
            ]);
        }

        return back();
    }
}
