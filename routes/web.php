<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterationController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get("/sign-up", [RegisterationController::class, "index"]);
Route::post("/sign-up", [RegisterationController::class, "store"]);

Route::get("/log-in", [LogInController::class, "index"]);
Route::post("/log-in", [LogInController::class, "check"]);

Route::middleware(["checkUser"])->group(function () {
    Route::get("/profile/{id}", [ProfileController::class, "showProfile"]);
    Route::get("/", [PostController::class, "index"]);
    Route::post('/post/{postId}/like', [PostController::class, 'likePost'])->name('post.like');
    Route::post('/post/comment/{postId}', [PostController::class, 'commentPost']);
    Route::post("/edit/profile/{id}", [ProfileController::class, "editProfileData"]);
    // Route::view("/edit/profile/3", "try");
    Route::post("/{userId}/post", [PostController::class, "uploadPost"]);
    Route::post('/posts/{postId}/comment', [PostController::class, 'commentPost'])->name('posts.comment');
    Route::view("/try", "try");
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');

});
