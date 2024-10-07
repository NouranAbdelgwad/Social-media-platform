<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function showProfile($id)
    {
        // Count accepted followers (those who follow the user with status 'accepted')
        $followersCount = Friend::where('friend_user_id', $id)
            ->where('status', 'accepted')
            ->count();

        // Count accepted followings (users that the current user is following)
        $followingCount = Friend::where('user_id', $id)
            ->where('status', 'accepted')
            ->count();

        // Retrieve the user's posts along with likes, comments, and user info
        $posts = Post::with(['likes', 'comments', 'user'])
            ->where('user_id', $id)
            ->get();

        // Get the user info (use findOrFail to return a 404 if the user doesn't exist)
        $user = User::findOrFail($id);

        // Pass variables to the profile view
        return view('profile', compact('followersCount', 'followingCount', 'posts', 'user'));
    }
    public function editProfileData($id, Request $request)
    {
        $user = User::findOrFail($id);

        // Validate request
        $request->validate([
            'picture_path' => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'name' => 'required|string|max:255',
        ]);

        // Update user data
        if ($request->hasFile('picture_path')) {
            $picturePath = $request->file('picture_path')->store('assets/images', 'public');
            $user->picture_path = $picturePath;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->save(); // Don't forget to save the user object

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }



}
