<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userPage(Request $request)
    {
        $id = auth()->user()->id;

        $user = User::select('id', 'name', 'username', 'bio')->where('username', $request->username)->firstOrFail();

        $can_follow = $id == $user->id ? false : true;

        $ids_follow = Follower::where('follower_user_id', $id)->where('user_id', $user->id)->exists();

        if ($ids_follow) {
            $follow = true;
        } else {
            $follow = false;
        }

        $stories = Story::select('id', 'slug', 'tags', 'title_preview', 'content_preview', 'created_at')
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'user' => $user,
            'stories' => $stories,
            'is_follow' => $follow,
            'can_follow' => $can_follow
        ]);
    }

    public function follows(Request $request)
    {
        $id_to_follow = $request->get('userId');

        // Find the User. Redirect if the User doesn't exist
        $user = User::where('id', $id_to_follow)->firstOrFail();

        // Find logged in User
        $id = auth()->user()->id;
        $me = User::find($id);
        $me->following()->attach($user->id);

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function unfollows(Request $request)
    {
        $id_to_follow = $request->get('userId');

        // Find the User. Redirect if the User doesn't exist
        $user = User::where('id', $id_to_follow)->firstOrFail();

        $id = auth()->user()->id;
        $me = User::find($id);
        $me->following()->detach($user->id);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
