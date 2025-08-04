<?php

namespace Tests\Integration;

use Tests\TestCase;

class StatisticsIntegrationTest extends TestCase
{
    public function testShouldBeSuccessWhenSendingGetStatistics()
    {
        // Arrange & Act
        $response = $this->getJson('/api/estatistica');

        // Assert
        $response->assertStatus(200);
        $response->assertJsonIsObject();
        $response->assertJsonStructure([
            'count',
            'sum',
            'average',
            'min',
            'max'
        ]);
    }
}
