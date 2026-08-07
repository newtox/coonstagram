<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('display_name', 'ASC')->paginate(20);

        return view('admin.users', [
            'users' => $users,
            'user' => $request->user(),
        ]);
    }

    public function toggleAdmin(Request $request, User $targetUser)
    {
        if ($targetUser->id === $request->user()->id) {
            return back()->withErrors(['admin' => __('admin.cannot_revoke_own_admin')]);
        }

        $targetUser->update(['is_admin' => ! $targetUser->is_admin]);

        return back()->with('status', __('admin.user_rights_updated'));
    }

    public function destroy(Request $request, User $targetUser)
    {
        if ($targetUser->id === $request->user()->id) {
            return back()->withErrors(['admin' => __('admin.cannot_delete_own_account_here')]);
        }

        if ($targetUser->avatar_path) {
            \Storage::disk('public')->delete($targetUser->avatar_path);
        }

        $targetUser->delete($targetUser->id);

        return back()->with('status', __('admin.account_deleted'));
    }
}
