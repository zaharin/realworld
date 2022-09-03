<?php

namespace Src\Bases;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function filterDecode(): array
    {
        $filter = $this->input('filter');
        return empty($filter)
            ? []
            : json_decode(urldecode($filter), true) ?? [];
    }
}
