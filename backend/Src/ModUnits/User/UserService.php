<?php

namespace Src\ModUnits\User;

use App\Models\User;
use Src\Bases\BaseService;

class UserService extends BaseService
{
    public function getCurrentUser()
    {
        return auth()->userOrFail();
    }

    public function getUserByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }
}
