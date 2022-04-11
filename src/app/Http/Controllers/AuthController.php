<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request ->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('secretToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login (Request $request) {
        $user;
        $fields = $request ->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($fields['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'username') {
            $user = User::where('username', $fields['username'])->first();
        } else {
            $user = User::where('email', $fields['username'])->first();
        }

        // check pasword
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'User not found'
            ], 401);
        }

        $token = $user->createToken('secretToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
