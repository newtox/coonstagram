<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggle(Request $request, User $targetUser)
    {
        $user = $request->user();

        if ($user->id === $targetUser->id) {
            return back();
        }

        if ($user->following()->where('followed_id', $targetUser->id)->exists()) {
            $user->following()->detach($targetUser->id);
        } else {
            $user->following()->attach($targetUser->id);
        }

        return back();
    }
}
