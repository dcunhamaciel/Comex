<?php

namespace App\Library;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JsonResponseApi
{
    public function __construct(
        private int $httpCode,
        private array $data
    ) {
    }

    public function toResponse(): JsonResponse
    {
        return response()->json(
            data: $this->data,
            status: $this->httpCode
        );
    }

    public static function index(ResourceCollection $resourceCollection): JsonResponse
    {
        $jsonResponseApi = new self(
            Response::HTTP_OK,
            $resourceCollection->resource->toArray()
        );

        return $jsonResponseApi->toResponse();
    }
}
