<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Support\Facades\Log;

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
        Log::info("Iniciando requisição das estatísticas");
        $statistics = $this->service->getStatistics();

        Log::info("Estatísticas calculadas com sucesso!");
        return response()->json($statistics->toArray(), 200);
    }
}
