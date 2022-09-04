<?php

namespace Src\ModUnits\User;

use Spatie\RouteAttributes\Attributes\Put;
use Src\Bases\BaseController;
use Src\ModUnits\User\Dto\UserResponseDto;
use Src\Shared\Dto\Responses\WrapResponseDto;


class UserController extends BaseController
{
    #[Put('user', middleware: 'auth:api')]
    public function currentUser()
    {
        $user = UserService::getCurrentUser();

        $user = UserResponseDto::fromModel($user);
        return WrapResponseDto::make('user', $user);
    }
}
