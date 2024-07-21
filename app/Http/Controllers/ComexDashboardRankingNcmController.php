<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ComexFilterRequest;
use App\Services\ComexService;
use App\DTOs\ComexFilterDto;

class ComexDashboardRankingNcmController extends Controller
{
    private ComexService $comexService;

    public function __construct()
    {
        $this->comexService = new ComexService();
    }

    public function index(ComexFilterRequest $request): JsonResponse
    {
        $comexRankingNcm = $this->comexService->getRankingByNcm(ComexFilterDto::fromApiRequest($request));

        return response()->json($comexRankingNcm, Response::HTTP_OK);
    }
}
