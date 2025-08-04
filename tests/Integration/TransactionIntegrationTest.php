<?php

namespace Tests\Integration;

use Tests\TestCase;

class TransactionIntegrationTest extends TestCase
{
    public function testShouldCreateANewTransaction()
    {
        // Arrange
        $transactionData = [
            'valor' => 1000,
            'dataHora' => '2025-07-30T14:10:05-03:00'
        ];

        // Act
        $response = $this->postJson('/api/transacao', $transactionData);

        // Assert
        $response->assertStatus(201);
    }

    public function testShouldBeUnprocessableEntityWhenSendingWrongTransaction()
    {
        // Arrange
        $transactionData = [
            'valor' => -1000,
            'dataHora' => '2025-07-30T14:10:05-03:00'
        ];

        // Act
        $response = $this->postJson('/api/transacao', $transactionData);

        // Assert
        $response->assertStatus(422);
    }

    public function testShouldBeBadRequestWhenSendingEmptyBody()
    {
        // Arrange
        $transactionData = [];

        // Act
        $response = $this->postJson('/api/transacao', $transactionData);

        // Assert
        $response->assertStatus(400);
    }

    public function testShouldBeSuccessWhenSendingDelete()
    {
        // Arrange
        $transactionData = [];

        // Act
        $response = $this->delete('/api/transacao');

        // Assert
        $response->assertStatus(200);
    }
}
