<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Health\Http\Controllers\HealthCheckJsonResultsController;
use Spatie\Health\ResultStores\ResultStore;

class CustomHealthCheckController extends HealthCheckJsonResultsController
{
    public function __invoke(Request $request, ResultStore $resultStore): Response {
        $checkResults = $resultStore->latestResults();

        $statusCode = $checkResults?->containsFailingCheck()
            ? config('health.json_results_failure_status', Response::HTTP_OK)
            : Response::HTTP_OK;
        
        $checkResults = $resultStore->latestResults();
        $result = $checkResults?->storedCheckResults[0];

        return response($result->meta ?? '', $statusCode)
            ->header('Content-Type', 'application/json')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    }
}
