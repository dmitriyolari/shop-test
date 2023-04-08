<?php

declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Resources\StatusResource;
use App\Models\User;
use App\Services\UserCreateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(UserCreateRequest $request, UserCreateService $service): JsonResponse
    {
        $validatedUser = $request->validated();
        $user = $service->create($validatedUser);
        Auth::login($user);
        $accessToken = $user->createToken('accessToken')->plainTextToken;

        return response()->json(['access_token' => $accessToken], 201);
    }

    public function login(UserLoginRequest $request): Response|JsonResponse
    {
        $validatedData = $request->validated();

        $user = User::where(function ($query) use ($validatedData) {
            $query->where('email', $validatedData['loginCredentials']);
            $query->orWhere('phone_number', $validatedData['loginCredentials']);
        })->first();
        if (!$user) {
            return response()->json(StatusResource::make(false), 422);
        }

        $dataToAuthenticateUser = [
            'email' => $user->getUserEmail(),
            'password' => $validatedData['password']
        ];
        if (Auth::attempt($dataToAuthenticateUser)) {
            Auth::login($user);
            $accessToken = $user->createToken('accessToken')->plainTextToken;

            return response()->json(['access_token' => $accessToken]);
        }

        return response()->json(StatusResource::make(false), 404);
    }
}
