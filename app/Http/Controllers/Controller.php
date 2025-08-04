<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="3.0.0",
 *      title="Falzoni Transactions Laravel",
 *      description="Api de demonstração de transações com PHP e Laravel"
 * ),
 * @OA\Schema(
 *  schema="Result",
 *  title="Transaction",
 * 	@OA\Property(
 *      property="valor",
 *      type="number",
 *      format="decimal",
 *      description="Valor da transação",
 *      example=1000
 * 	),
 * 	@OA\Property(
 * 		property="dataHora",
 * 		type="string",
 * 		format="date-time",
 * 		description="Data e hora da transação",
 * 		example="2023-01-01T00:00:00-03:00"
 * 	)
 * )
 */
abstract class Controller
{
    //
}
