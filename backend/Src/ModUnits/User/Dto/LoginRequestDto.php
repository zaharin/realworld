<?php

namespace Src\ModUnits\User\Dto;

use OpenApi\Attributes as OA;
use Src\Bases\BaseDto;

#[OA\Schema]
class LoginRequestDto extends BaseDto
{
    #[OA\Property]
    public string $email;

    #[OA\Property]
    public string $password;
}
