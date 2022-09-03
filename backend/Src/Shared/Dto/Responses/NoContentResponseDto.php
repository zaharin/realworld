<?php

namespace Src\Shared\Dto\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Src\Bases\BaseDto;

final class NoContentResponseDto extends BaseDto implements Responsable
{
    public int $status = Response::HTTP_NO_CONTENT;

    public function toResponse($request): JsonResponse
    {

        return response()->json([], $this->status);
    }

    public static function make(): self
    {
        return new self();
    }
}
