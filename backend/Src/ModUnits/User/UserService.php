<?php

namespace Src\ModUnits\User;

use App\Models\User;
use Src\Bases\BaseService;

class UserService extends BaseService
{
    public static function getCurrentUser(): User
    {
        return auth('api')->userOrFail();
    }

    public function getUserByUsername(string $username): User
    {
        return User::where('username', $username)->firstOrFail();
    }
}
