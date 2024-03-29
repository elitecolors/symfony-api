<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/** @coversDefaultClass \App\Controller\StockController */
class StockControllerTest extends WebTestCase
{
    public const URL = 'api/stock';

    private $client = null;
    protected function setup(): void
    {
        parent::setUp();

        $this->client  = static::createClient();
    }

    protected function tearDown(): void
    {
        $this->client = null;

        parent::tearDown();
    }

    /**
     * @covers ::getStockData
     */
    public function testGetStockData(): void
    {
        $this->client->request('GET', self::URL);

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
