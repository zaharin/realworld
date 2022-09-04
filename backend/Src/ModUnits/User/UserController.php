<?php

namespace Src\ModUnits\User;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Put;
use Src\Bases\BaseController;
use Src\ModUnits\User\Dto\UserResponseDto;
use Src\ModUnits\User\Requests\UserUpdateRequest;
use Src\Shared\Dto\Responses\WrapResponseDto;

#[Middleware('auth:api')]
class UserController extends BaseController
{
    #[Get('user')]
    public function current()
    {
        $user = UserService::getCurrentUser();
        $user = UserResponseDto::fromModel($user);

        return WrapResponseDto::make('user', $user);
    }

    #[Put('user')]
    public function update(UserUpdateRequest $request, UserService $service)
    {
        $user = $service->update($request->data());
        $user = UserResponseDto::fromModel($user);

        return WrapResponseDto::make('user', $user);
    }
}
