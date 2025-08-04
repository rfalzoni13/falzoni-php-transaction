<?php

namespace App\Models;

use DateTime;

class Transaction 
{
    private float $valor;
    private DateTime $dataHora;

    public function __construct(float $valor, DateTime $dataHora)
    {
        $this->valor = $valor;
        $this->dataHora = $dataHora;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getDataHora(): DateTime
    {
        return $this->dataHora;
    }
}
?>