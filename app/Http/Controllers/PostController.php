<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // app/Http/Controllers/PostController.php

    public function index()
{
    $posts = Post::with(['user', 'likes', 'comments'])->get();
    $friends = User::where('id', '!=', Auth::id())->get();
    return view('welcome', compact('posts', 'friends'));
}

    public function likePost(Request $request, $postId)
    {
        $like = Like::firstOrCreate([
            'post_id' => $postId,
            'user_id' => Auth::id(),
        ]);
        return redirect()->back();
    }

    public function commentPost(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);
        Comment::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);
        return back();
    }
    public function uploadPost(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'post_pic_path' => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'content' => 'required|string|max:255',
        ]);
        if ($request->hasFile('post_pic_path')) {
            $postPic = $request->file('post_pic_path')->store('assets/images', 'public');
        } else {
            $postPic = null;
        }
        post::create([
            "user_id" => $userId,
            "content" => $request->input('content'),
            "post_pic_path" => $postPic,
            "location" => "Cairo, Egypt",
        ]);
        return redirect("/")->with('success', 'Post created successfully!');
    }

}
