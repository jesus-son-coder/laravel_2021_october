<?php

namespace App\Services;

use App\Exceptions\UserNotfoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function findByUsername($username)
    {
        $user = User::where('username', $username)->first();

        if(! $user) {
            throw new UserNotfoundException('Hey, do you know that User is not found ?');
        }

        return $user;
    }
}


