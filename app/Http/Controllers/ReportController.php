<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, Post $post)
    {
        if ($post->user_id === $request->user()->id) {
            abort(403);
        }

        $data = $request->validate([
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $post->reports()->firstOrCreate(
            ['user_id' => $request->user()->id],
            ['reason' => $data['reason'] ?? null]
        );

        return back()->with('status', __('feed.report_submitted'));
    }
}
