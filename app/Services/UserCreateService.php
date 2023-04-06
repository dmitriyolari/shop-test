<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;

class UserCreateService
{
    public function create(array $userCredentials): User
    {
        $typedData = UserDTO::checkTypes($userCredentials);
        $typedData['password'] = bcrypt($typedData['password']);

        $user = new User();
        $user->fill($typedData);
        $user->save();

        return $user;
    }

}
