<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $response = [
            'user' => $user,
        ];
        return response($response, 200);
    }
    public function show(User $user)
    {
        return new UserResource($user);
    }
}
