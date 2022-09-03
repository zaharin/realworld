<?php

namespace Src\ModUnits\User;

use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Src\Bases\BaseController;
use Src\ModUnits\User\Dto\UserTokenResponseDto;
use Src\ModUnits\User\Requests\LoginRequest;
use Src\ModUnits\User\Requests\RegistrationRequest;
use Src\Shared\Dto\Responses\ErrorResponseDto;
use Src\Shared\Dto\Responses\NoContentResponseDto;
use Src\Shared\Dto\Responses\WrapResponseDto;

#[OA\Tag(name: 'auth', description: 'Authentication')]
#[Prefix('users')]
class AuthController extends BaseController
{
    #[Post('/')]
    public function register(RegistrationRequest $request, AuthService $service)
    {
        [$user, $token] = $service->register($request->data());

        $user = UserTokenResponseDto::fromModel($user, $token);
        return WrapResponseDto::make('user', $user);
    }

    #[Post('login')]
    public function login(LoginRequest $request, AuthService $service)
    {
        [$user, $token] = $service->login($request->data());
        if (!$token) {
            return ErrorResponseDto::make('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $user = UserTokenResponseDto::fromModel($user, $token);
        return WrapResponseDto::make('user', $user);
    }

    #[Post('logout', middleware: 'auth:api')]
    public function logout(AuthService $service)
    {
        $service->logout();
        return NoContentResponseDto::make();
    }
}
