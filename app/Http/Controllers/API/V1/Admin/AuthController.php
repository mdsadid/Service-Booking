<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'Invalid credentials!',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('username', $validated['username'])->first();

        if (!$user->is_admin) {
            return response()->json([
                'message' => 'Access denied!',
            ], Response::HTTP_FORBIDDEN);
        }

        $token = $user->createToken("API Token of $user->name")->plainTextToken;

        return response()->json([
            'message' => 'Welcome back!',
            'token'   => $token,
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'See ya next time!',
        ]);
    }
}
