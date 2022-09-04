<?php

namespace Src\ModUnits\User\Dto;

use OpenApi\Attributes as OA;
use Src\Bases\BaseDto;

#[OA\Schema]
class UserUpdateRequestDto extends BaseDto
{
    #[OA\Property]
    public ?string $email;

    #[OA\Property]
    public ?string $username;

    #[OA\Property]
    public ?string $password;

    #[OA\Property]
    public ?string $bio;

    #[OA\Property]
    public ?string $image;
}
