<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserLoginService
{
    public static function generateTokenOnSuccessfulLogin(): string
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->createToken('accessToken')->plainTextToken;
    }

}
