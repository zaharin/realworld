<?php

namespace Src\ModUnits\User\Requests;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseRequest;
use Src\ModUnits\User\Dto\LoginRequestDto;

class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'user.email' => 'required|email',
            'user.password' => 'required|string',
        ];
    }

    /**
     * @throws UnknownProperties
     */
    public function data(): LoginRequestDto
    {
        return new LoginRequestDto([
            'email' => $this->input('user.email'),
            'password' => $this->input('user.password')
        ]);
    }
}
