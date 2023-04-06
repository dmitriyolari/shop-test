<?php

declare(strict_types=1);

namespace App\DTO;

class UserDTO
{
    public function __construct(
        public string $full_name,
        public string $email,
        public string $phone_number,
        public string $password
    ) {
    }

    public static function checkTypes($userCredentials): array
    {
        $checkedTypes = self::fromArrayToObject($userCredentials);
        return self::fromObjectToArray($checkedTypes);
    }

    public static function fromArrayToObject(array $userCredentials): UserDTO
    {
        return new self(
            $userCredentials['full_name'],
            $userCredentials['email'],
            $userCredentials['phone_number'],
            $userCredentials['password'],
        );
    }

    public static function fromObjectToArray(UserDTO $userDTO): array
    {
        return [
            'full_name' => $userDTO->full_name,
            'email' => $userDTO->email,
            'phone_number' => $userDTO->phone_number,
            'password' => $userDTO->password
        ];
    }
}
