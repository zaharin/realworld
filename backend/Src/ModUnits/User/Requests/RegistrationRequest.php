<?php

namespace Src\ModUnits\User\Requests;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseRequest;
use Src\ModUnits\User\Dto\RegistrationRequestDto;

class RegistrationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'user.email' => 'required|email|unique:users,email',
            'user.username' => 'required|string|unique:users,username',
            'user.password' => 'required|string',
        ];
    }

    /**
     * @throws UnknownProperties
     */
    public function data(): RegistrationRequestDto
    {
        return new RegistrationRequestDto([
            'email' => $this->input('user.email'),
            'username' => $this->input('user.username'),
            'password' => $this->input('user.password')
        ]);
    }
}
