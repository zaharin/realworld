<?php

namespace Src\ModUnits\User\Dto;

use App\Models\User;
use OpenApi\Attributes as OA;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseDto;

#[OA\Schema]
class ProfileResponseDto extends BaseDto
{
    #[OA\Property]
    public string $username;

    #[OA\Property]
    public ?string $bio;

    #[OA\Property]
    public ?string $image;

    #[OA\Property]
    public bool $following;

    /**
     * @throws UnknownProperties
     */
    public static function fromModel(User $model, bool $following): static
    {
        return new static($model->only(
                'username',
                'bio',
                'image',
            ) + ['following' => $following]);
    }
}
