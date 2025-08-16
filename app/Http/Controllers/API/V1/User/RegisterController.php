<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __invoke(UserRegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create(
            array_merge(
                $validated,
                ['password' => Hash::make($validated['password'])]
            )
        );

        return response()->json([
            'message' => 'User registered successfully.',
            'user'    => new UserResource($user),
        ], Response::HTTP_CREATED);
    }
}
