<?php

namespace Src\Shared\Dto\Responses;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Src\Bases\BaseDto;

final class PaginationDataResponseDto extends BaseDto implements Responsable
{
    public LengthAwarePaginator $paginator;

    /** @var BaseDto|array */
    public mixed $collection;

    public int $status = Response::HTTP_OK;

    public function toResponse($request): JsonResponse
    {
        $collection = $this->collection;
        if ($collection instanceof Arrayable) {
            $collection = $collection->toArray();
        }

        return response()->json(
            [
                'data' => $collection,
                'meta' => [
                    'current_page' => $this->paginator->currentPage(),
                    'last_page' => $this->paginator->lastPage(),
                    'path' => $this->paginator->path(),
                    'per_page' => $this->paginator->perPage(),
                    'total' => $this->paginator->total(),
                ],
            ],
            $this->status
        );
    }

    /**
     * @throws UnknownProperties
     */
    public static function make(mixed $collection, LengthAwarePaginator $paginator, int $status = Response::HTTP_OK): self
    {
        return new self([
            'collection' => $collection,
            'paginator' => $paginator,
            'status' => $status,
        ]);
    }
}
