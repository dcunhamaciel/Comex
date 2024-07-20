<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ComexFilterRequest;
use App\Http\Resources\ComexListResource;
use App\Library\JsonResponseApi;
use App\Services\ComexService;
use App\DTOs\ComexFilterDto;

class ComexListController extends Controller
{
    private ComexService $comexService;

    public function __construct()
    {
        $this->comexService = new ComexService();
    }

    public function index(ComexFilterRequest $request): JsonResponse
    {
        $comexList = $this->comexService->findAll(ComexFilterDto::fromApiRequest($request));

        return JsonResponseApi::index(ComexListResource::collection($comexList));
    }
}
