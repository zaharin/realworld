<?php

namespace Src\Shared\Dto\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseDto;

final class WrapResponseDto extends BaseDto implements Responsable
{
    public string $name;

    public mixed $data;

    public int $status = Response::HTTP_OK;

    public function toResponse($request): JsonResponse
    {

        return response()->json(
            [
                $this->name => $this->data,
            ],
            $this->status
        );
    }

    /**
     * @throws UnknownProperties
     */
    public static function make(string $name, mixed $data, int $status = Response::HTTP_OK): self
    {
        return new self([
            'name' => $name,
            'data' => $data,
            'status' => $status,
        ]);
    }
}
