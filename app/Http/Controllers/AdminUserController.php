<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function edit(Request $request, User $targetUser)
    {
        return view('admin.users-edit', [
            'targetUser' => $targetUser,
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, User $targetUser)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $targetUser->id],
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9_]+$/', 'unique:users,username,' . $targetUser->id],
            'display_name' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $targetUser->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'display_name' => $data['display_name'] ?? null,
            'title' => $data['title'] ?? null,
            'bio' => $data['bio'] ?? null,
        ]);

        if ($targetUser->isDirty('email')) {
            $targetUser->email_verified_at = null;
        }

        if (! empty($data['password'])) {
            $targetUser->password = Hash::make($data['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($targetUser->avatar_path) {
                Storage::disk('public')->delete($targetUser->avatar_path);
            }
            $targetUser->avatar_path = $request->file('avatar')->store('avatars', 'public');
        }

        $targetUser->save();

        return redirect()->route('admin.users.index')->with('status', __('admin.user_updated'));
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
