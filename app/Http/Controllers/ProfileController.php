<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        $stories = Story::where('user_id', $user_id)->orderBy('id', 'desc')->get();

        return response()->json([
            'stories' => $stories,
            'user_name' => auth()->user()->name
        ], 200);
    }

    public function settings()
    {
        $user_id = auth()->user()->id;

        $user_infos = User::where('id', $user_id)->first();

        return response()->json([
            'user_infos' => $user_infos,
        ], 200);
    }

    public function updateInfos(Request $request)
    {
        $user_id = auth()->user()->id;

        $user = User::where('id', $user_id)->first();

        $requestData = $request->all();

        $user->update($requestData);

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
