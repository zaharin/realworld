<?php

namespace Src\Bases;

use Illuminate\Contracts\Support\Arrayable;
use Spatie\DataTransferObject\Arr;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseDto extends DataTransferObject implements Arrayable
{
    public function withoutNullable(): array
    {
        $data = Arr::except($this->all(), $this->exceptKeys);

        foreach ($data as $key => $item) {
            if (is_null($item)) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
