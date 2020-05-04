<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
