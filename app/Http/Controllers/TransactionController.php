<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Tag(
 *   name="Transação"
 * )
 */
class TransactionController extends Controller
{
    public function __construct(private TransactionService $service)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/transacao",
     *     tags={"Transação"},
     *     summary="Registrar transação",
     *     description="Endpoint que grava uma nova transação",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="valor",
     *                     type="number",
     *                     format="decimal"
     *                 ),
     *                 @OA\Property(
     *                     property="dataHora",
     *                     type="string",
     *                     format="date-time"
     *                 ),
     *                 example={"valor": 1000, "dataHora": "2023-01-01T00:00:00-03:00"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
     *
     */
    public function receive(Request $request)
    {
        Log::info("Recebendo transação");

        $this->service->receive($request->all());
        
        Log::info("Transação recebida com sucesso");

        return response()->noContent(201);
    }

    /**
     * @OA\Delete(
     *     path="/api/transacao",
     *     tags={"Transação"},
     *     summary="Remover transações",
     *     description="Endpoint que remove todas as transações registradas",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     *
     */
    public function delete()
    {
        $this->service->clear();
        return response()->noContent(200);
    }
}
