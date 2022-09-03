<?php

namespace Src\ModUnits\User;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Src\Bases\BaseController;
use Src\ModUnits\User\Dto\ProfileResponseDto;
use Src\ModUnits\User\Dto\UserResponseDto;
use Src\Shared\Dto\Responses\NoContentResponseDto;
use Src\Shared\Dto\Responses\WrapResponseDto;


class UserController extends BaseController
{
    #[Put('user', middleware: 'auth:api')]
    public function currentUser(UserService $service)
    {
        $user = $service->getCurrentUser();

        $user = UserResponseDto::fromModel($user);
        return WrapResponseDto::make('user', $user);
    }

    #[Get('profiles/{username}')]
    public function profiles(string $username, UserService $service)
    {
        $user = $service->getUserByUsername($username);
        if ($user === null) {
            return NoContentResponseDto::make();
        }

        // todo сделать проверку following
        $following = false;
        $user = ProfileResponseDto::fromModel($user, $following);
        return WrapResponseDto::make('profile', $user);
    }
}
