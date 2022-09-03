<?php

namespace Src\ModUnits\User\Dto;

use App\Models\User;
use OpenApi\Attributes as OA;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseDto;

#[OA\Schema]
class UserResponseDto extends BaseDto
{
    #[OA\Property]
    public string $email;

    #[OA\Property]
    public string $username;

    #[OA\Property]
    public ?string $bio;

    #[OA\Property]
    public ?string $image;

    /**
     * @throws UnknownProperties
     */
    public static function fromModel(User $model): static
    {
        return new static($model->only(
            'email',
            'username',
            'bio',
            'image',
        ));
    }
}
