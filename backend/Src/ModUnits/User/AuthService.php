<?php

namespace Src\ModUnits\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;
use Src\Bases\BaseService;
use Src\ModUnits\User\Dto\LoginRequestDto;
use Src\ModUnits\User\Dto\RegistrationRequestDto;

class AuthService extends BaseService
{
    private function guard(): JWTGuard
    {
        return auth('api');
    }

    #[ArrayShape([User::class | null, 'string'])]
    public function login(LoginRequestDto $data): array
    {
        $credentials = $data->only('email', 'password')->toArray();
        $token = $this->guard()->attempt($credentials);

        if (!$token) {
            return [null, $token];
        }

        return [$this->guard()->user(), $token];
    }

    public function logout(): void
    {
        $this->guard()->logout();
    }

    #[ArrayShape([User::class | null, 'string'])]
    public function register(RegistrationRequestDto $data): array
    {
        $user = User::create(
            $data->except('password')->toArray() +
            ['password' => Hash::make($data->password)]
        );

        $token = $this->guard()->login($user);
        return [$this->guard()->user(), $token];
    }
}
