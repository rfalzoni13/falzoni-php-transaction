<?php

namespace App\Services;

use App\Models\SummaryStatistics;
use App\Models\Transaction;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use SanderMuller\Stopwatch\Stopwatch;

class TransactionService
{
    private array $transactions;

    public function __construct()
    {
        $this->transactions = Cache::get('transactions') !== null ? Cache::get('transactions') : [];
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function receive(array $obj): void
    {
        $valor = $obj['valor'];
        $dataHora = strtotime($obj['dataHora']);
        $dateTime = date('Y-m-d H:i:s', $dataHora);
        $transaction = new Transaction($valor, DateTime::createFromFormat('Y-m-d H:i:s', $dateTime));

        Log::info("Transação validada - adicionando ao histórico");
        $this->transactions[] = $transaction;
        Cache::put('transactions', $this->transactions, 1800);
    }

    public function clear(): void
    {
        Log::info("Limpando transações registradas");
        Cache::forget('transactions');
    }

    public function getStatistics(): SummaryStatistics
    {
        Log::info("Calculando estatísticas das transações");

        $stopWatch = StopWatch::start();

        $filteredTransactions = array_filter($this->transactions, function (Transaction $transaction) {
            return $transaction->getDataHora() >= now()->addSeconds(-60) &&
                $transaction->getDataHora() < now();
        });

        $count = count($filteredTransactions);
        $sum = array_sum(array_map(fn($t) => $t->getValor(), $filteredTransactions));
        $average = $count > 0 ? $sum / $count : 0;
        $min = !empty($filteredTransactions) ? min(array_map(fn($t) => $t->getValor(), $filteredTransactions)) : 0;
        $max = !empty($filteredTransactions) ? max(array_map(fn($t) => $t->getValor(), $filteredTransactions)) : 0;

        $statistics = new SummaryStatistics(
            $count,
            $sum,
            $average,
            $min,
            $max,
        );
        
        $stopWatch->stop();

        Log::info("Estatísticas calculadas em " . $stopWatch);
        return $statistics;
    }
}
