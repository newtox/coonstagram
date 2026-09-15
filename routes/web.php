<?php

use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FeedController::class, 'index']);

Route::get('/feed', [FeedController::class, 'index'])->name('feed');

Route::get('/profile/{user:username}', [UserProfileController::class, 'show'])->name('profile.show');

Route::get('/language/{locale}', function (string $locale) {
    if (in_array($locale, ['de', 'en'])) {
        session(['locale' => $locale]);
    }

    return back();
})->name('locale.switch');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user:username}/followers', [UserProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{user:username}/following', [UserProfileController::class, 'following'])->name('profile.following');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/posts/{post}/report', [ReportController::class, 'store'])->name('posts.report');
    Route::post('/users/{targetUser}/follow', [FollowController::class, 'toggle'])->name('users.follow');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{targetUser}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{targetUser}', [AdminUserController::class, 'update'])->name('users.update');
    Route::patch('/users/{targetUser}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{targetUser}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/{post}/dismiss', [AdminReportController::class, 'dismiss'])->name('reports.dismiss');
});

require __DIR__ . '/auth.php';
