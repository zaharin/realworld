<?php

namespace Src\ModUnits\Profile;

use OpenApi\Attributes as OA;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Src\Bases\BaseController;
use Src\ModUnits\Profile\Dto\ProfileResponseDto;
use Src\ModUnits\User\UserService;
use Src\Shared\Dto\Responses\WrapResponseDto;

#[OA\Tag(name: 'profile', description: 'Profile')]
#[Prefix('profiles')]
class ProfileController extends BaseController
{
    #[Post('{username}/follow', middleware: 'auth:api')]
    public function follow(string $username, ProfileService $service)
    {
        $userFollowing = $service->follow($username);
        $user = ProfileResponseDto::fromModel($userFollowing, true);

        return WrapResponseDto::make('profile', $user);
    }

    #[Delete('{username}/unfollow', middleware: 'auth:api')]
    public function unfollow(string $username, ProfileService $service)
    {
        $userFollowing = $service->unfollow($username);
        $user = ProfileResponseDto::fromModel($userFollowing, false);

        return WrapResponseDto::make('profile', $user);
    }

    #[Get('{username}')]
    public function profile(string $username, ProfileService $service, UserService $userService)
    {
        $userFollowing = $userService->getUserByUsername($username);
        $following = $service->isFollowing($userFollowing);
        $user = ProfileResponseDto::fromModel($userFollowing, $following);

        return WrapResponseDto::make('profile', $user);
    }
}
