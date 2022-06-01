<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Auth;

class AuthController
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $token = $user->createToken('admin')->accessToken;
            // dd($token);

            return [
                'token' => $token
            ];
        }

        return response([
            'error' => 'Invalid Credentials !',
        ], HttpFoundationResponse::HTTP_UNAUTHORIZED);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('name', 'email') +
            ['password' => Hash::make($request->input('password'))]);
        return response($user, HttpFoundationResponse::HTTP_CREATED);
    }
}
