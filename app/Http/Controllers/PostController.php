<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'body' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:5120'],
        ];

        if ($request->user()->isAdmin()) {
            $rules['post_as'] = ['nullable', 'exists:users,id'];
        }

        $data = $request->validate($rules);

        if (! $request->filled('body') && ! $request->hasFile('image')) {
            return back()->withErrors(['body' => 'Post braucht Text oder ein Bild.']);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $authorId = $request->user()->id;

        if ($request->user()->isAdmin() && $request->filled('post_as')) {
            $authorId = $data['post_as'];
        }

        Post::create([
            'user_id' => $authorId,
            'body' => $data['body'] ?? null,
            'image_path' => $imagePath,
        ]);

        return back()->with('status', 'Post erstellt!');
    }

    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id && ! $request->user()->isAdmin()) {
            abort(403);
        }

        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete($post->id);

        return back()->with('status', 'Post gelöscht.');
    }
}
