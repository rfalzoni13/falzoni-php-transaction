<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;

/**
 * @OA\Tag(
 *   name="Estatística"
 * )
 */
class StatisticController extends Controller
{
    public function __construct(private TransactionService $service)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/estatistica",
     *     tags={"Estatística"},
     *     summary="Calcular estatísticas",
     *     description="Endpoint que retorna as estatísticas das transações nos últimos 60 segundos",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     *
     */
    public function getStatistics()
    {
        $statistics = $this->service->getStatistics();
        return response()->json($statistics->toArray(), 200);
    }
}
