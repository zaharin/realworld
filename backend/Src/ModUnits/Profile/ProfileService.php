<?php

namespace Src\ModUnits\Profile;

use App\Models\User;
use Src\Bases\BaseService;
use Src\ModUnits\User\UserService;

class ProfileService extends BaseService
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function isFollowing(User $userFollowing): bool
    {
        $user = UserService::getCurrentUser();
        return $user->followers()
            ->where('follower_id', $userFollowing->getKey())
            ->exists();
    }

    public function follow(string $username): User
    {
        $followUser = $this->userService->getUserByUsername($username);
        $user = UserService::getCurrentUser();
        $user->followers()->attach($followUser);

        return $followUser;
    }

    public function unfollow(string $username): User
    {
        $followUser = $this->userService->getUserByUsername($username);
        $user = UserService::getCurrentUser();
        $user->followers()->detach($followUser);

        return $followUser;
    }
}
