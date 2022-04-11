<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        $credentials = [
            'email' => $input['email'],
            'password' => $input['password'],
        ];

        if (! $token = auth()->attempt($credentials)) {
            //Da para melhorar esse código implementando exeptions aqui
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // dd($token);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
