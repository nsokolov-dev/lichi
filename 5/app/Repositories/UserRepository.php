<?php

namespace App\Repositories;

class UserRepository
{
    public function userExists(string $email): bool
    {
        $existsUsers = [
            ['id' => 1, 'email' => 'johndoe@gmail.com', 'first_name' => 'John'],
            ['id' => 2, 'email' => 'anna@yandex.ru', 'first_name' => 'Anna'],
        ];

        $filtered = array_filter($existsUsers, function ($user) use ($email) {
            return $user['email'] == $email;
        });

        return count($filtered) > 0;
    }
}
