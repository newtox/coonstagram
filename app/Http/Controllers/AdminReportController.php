<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $reportedPosts = Post::whereHas('reports')
            ->with(['user', 'reports.user'])
            ->withCount('reports')
            ->orderByDesc('reports_count')
            ->paginate(20);

        return view('admin.reports', [
            'reportedPosts' => $reportedPosts,
            'user' => $request->user(),
        ]);
    }

    public function dismiss(Request $request, Post $post)
    {
        $post->reports()->delete();

        return back()->with('status', __('coonstagram.reports_dismissed'));
    }
}
