<?php

namespace Tests\Unit;

use App\Services\TransactionService;
use Tests\TestCase;

class TransactionServiceTest extends TestCase
{
    private TransactionService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new TransactionService();        
    }

    public function testShouldBeCreateWhenReceiveTransaction()
    {
        // Arrange
        $transactionData = [
            'valor' => 1000,
            'dataHora' => '2025-07-30T14:10:05-03:00'
        ];

        // Act
        $this->service->receive($transactionData);

        // Assert
        $this->assertGreaterThan(0, count($this->service->getTransactions()));
        $this->assertNotEquals($this->service->getTransactions(), []);
    }

    public function testShouldBeSuccessWhenClearTransactions()
    {
        // Act
        $this->service->clear();

        // Assert
        $this->assertEmpty($this->service->getTransactions());
        $this->assertEquals(0, count($this->service->getTransactions()));
    }

    public function testShouldBeSuccessWhenCalculateStatistics()
    {
        $this->service->clear(); // Ensure we start with an empty transaction list

        // Arrange
        $transactionDataOne = [
            'valor' => 1000,
            'dataHora' => date(DATE_ATOM, time() - 10) // 10 seconds ago
        ];
        $transactionDataTwo = [
            'valor' => 2000,
            'dataHora' => date(DATE_ATOM, time() - 20) // 20 seconds ago
        ];
        $transactionDataThree = [
            'valor' => 1000,
            'dataHora' => date(DATE_ATOM, time() - 30) // 30 seconds ago
        ];
        $this->service->receive($transactionDataOne);
        $this->service->receive($transactionDataTwo);
        $this->service->receive($transactionDataThree);

        // Act
        $statistics = $this->service->getStatistics();
        
        // Assert
        $this->assertNotEmpty($statistics);
        $this->assertEquals(3, $statistics->getCount());
        $this->assertEquals(4000, $statistics->getSum());
        $this->assertEquals(1333.33, round($statistics->getAverage(), 2));
        $this->assertEquals(1000, $statistics->getMin());
        $this->assertEquals(2000, $statistics->getMax());
    }
}