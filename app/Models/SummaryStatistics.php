<?php

namespace App\Models;

class SummaryStatistics
{
    private int $count;
    private float $sum;
    private float $average;
    private float $min;
    private float $max;

    public function __construct(int $count, float $sum, float $average, float $min, float $max)
    {
        $this->count = $count;
        $this->sum = $sum;
        $this->average = $average;
        $this->min = $min;
        $this->max = $max;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function getAverage(): float
    {
        return $this->average;
    }

    public function getMin(): float
    {
        return $this->min;
    }

    public function getMax(): float
    {
        return $this->max;
    }

    public function toArray(): array
    {
        return [
            'count' => $this->getCount(),
            'sum' => $this->getSum(),
            'average' => $this->getAverage(),
            'min' => $this->getMin(),
            'max' => $this->getMax(),
        ];
    }
}