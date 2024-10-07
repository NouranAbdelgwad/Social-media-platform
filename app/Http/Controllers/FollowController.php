<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    // Method to follow a user
    public function follow($id)
    {
        $authUserId = Auth::user()->id;

        // Check if the follow record already exists
        $exists = DB::table('friends')
            ->where('user_id', $authUserId)
            ->where('friend_user_id', $id)
            ->exists();

        // If not following, insert a new record
        if (!$exists) {
            DB::table('friends')->insert([
                'user_id' => $authUserId,
                'friend_user_id' => $id,
                'status' => 'accepted',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('success', 'You are now following user ' . $id);
        }

        return redirect()->back()->with('info', 'You are already following user ' . $id);
    }

    // Method to unfollow a user
    public function unfollow($id)
    {
        $authUserId = Auth::user()->id;

        // Remove the follow record from the database
        $deleted = DB::table('friends')
            ->where('user_id', $authUserId)
            ->where('friend_user_id', $id)
            ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'You have unfollowed user ' . $id);
        }

        return redirect()->back()->with('info', 'You are not following user ' . $id);
    }
}
