<?php

namespace Src\ModUnits\User\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseRequest;
use Src\ModUnits\User\Dto\UpdateRequestDto;
use Src\ModUnits\User\UserService;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        $user = UserService::getCurrentUser();

        return [
            'user.email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique(User::class, 'email')->ignore($user)
            ],
            'user.username' => [
                'sometimes',
                'required',
                'string',
                Rule::unique(User::class, 'username')->ignore($user)
            ],
            'user.password' => 'sometimes|required|string',
            'user.bio' => 'sometimes|nullable|string',
            'user.image' => 'sometimes|nullable|string',
        ];
    }

    /**
     * @throws UnknownProperties
     */
    public function data(): UpdateRequestDto
    {
        return new UpdateRequestDto([
            'email' => $this->input('user.email'),
            'username' => $this->input('user.username'),
            'password' => $this->input('user.password'),
            'bio' => $this->input('user.bio'),
            'image' => $this->input('user.image'),
        ]);
    }
}
