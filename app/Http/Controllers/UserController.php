<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
