<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ComexFilterRequest;
use App\Services\ComexService;
use App\DTOs\ComexFilterDto;

class ComexDashboardTransportController extends Controller
{
    private ComexService $comexService;

    public function __construct()
    {
        $this->comexService = new ComexService();
    }

    public function index(ComexFilterRequest $request): JsonResponse
    {
        $comexTotalByTransport = $this->comexService->getTotalByTransport(ComexFilterDto::fromApiRequest($request));

        return response()->json($comexTotalByTransport, Response::HTTP_OK);
    }
}
