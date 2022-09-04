<?php

namespace Src\ModUnits\User;

use App\Models\User;
use Src\Bases\BaseService;
use Src\ModUnits\User\Dto\UpdateRequestDto;

class UserService extends BaseService
{
    private readonly array $with;

    public function __construct()
    {
        $this->with = [];
    }

    public static function getCurrentUser(): User
    {
        return auth('api')->userOrFail();
    }

    public function getUserByUsername(string $username): User
    {
        return User::where('username', $username)->firstOrFail();
    }

    public function update(UpdateRequestDto $data): User
    {
        $model = self::getCurrentUser();
        $model->update($data->withoutNullable());
        $model->load($this->with);

        return $model;
    }
}
