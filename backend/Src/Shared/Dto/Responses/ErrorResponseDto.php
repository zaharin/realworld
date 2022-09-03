<?php

namespace Src\Shared\Dto\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseDto;

final class ErrorResponseDto extends BaseDto implements Responsable
{
    public string $message;

    public mixed $errors;

    public int $status = Response::HTTP_BAD_REQUEST;

    public function toResponse($request): JsonResponse
    {

        return response()->json(
            [
                'errors' => $this->errors,
                'message' => $this->message,
            ],
            $this->status
        );
    }

    /**
     * @throws UnknownProperties
     */
    public static function make(string $message, mixed $errors = '', int $status = Response::HTTP_BAD_REQUEST): self
    {
        return new self([
            'message' => $message,
            'errors' => $errors,
            'status' => $status,
        ]);
    }
}
