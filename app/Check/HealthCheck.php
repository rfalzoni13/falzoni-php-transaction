<?php

namespace App\Check;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;

class HealthCheck extends Check
{
    public function run(): Result
    {
        $result = Result::make();

        $result->meta([
            'status' => 'API Funcionando'
        ]);

        return $result;
    }
}
