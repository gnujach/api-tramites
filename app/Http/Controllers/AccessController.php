<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AccessController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['fails']
            ], 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    /**
     * @param user
     */
    public function logout(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user->tokens()->delete()) {
            $response = [
                'logout' => true,
            ];
            return response($response, 201);
        } else {
            return response('Error', 404);
        }
    }
}
