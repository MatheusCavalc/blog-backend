<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);

        $username = explode("@", $userData['email']);
        $userData['username'] = '@' . $username[0];

        if (!$user = $user->create($userData))
            abort(500, 'Error to create a new user...');

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ], 200);
    }
}
