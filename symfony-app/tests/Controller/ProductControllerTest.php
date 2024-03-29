<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/** @coversDefaultClass \App\Controller\ProductController */
class ProductControllerTest extends WebTestCase
{
    public const URL = 'api/product';

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
     * @dataProvider addProductProvider
     * @covers ::addProduct
     */
    public function testAddProduct(array $requestParam, int $responseCode): void
    {
        $this->client->request('POST', self::URL, $requestParam);
        $this->assertSame($this->client->getResponse()->getStatusCode(), $responseCode);
    }

    public function addProductProvider(): array
    {
        return [
            'Test invalid form' => [
                [],
                Response::HTTP_BAD_REQUEST,
            ],
            'test with wrong data' => [
                [
                    'code' => 'test',
                    'qty' => 'test',
                    'price' => '4'
                ],
                Response::HTTP_BAD_REQUEST,
            ],
            'test valid request' => [
                [
                    'code' => 'test',
                    'qty' => 45,
                    'price' => '4'
                ],
                Response::HTTP_OK,
            ],
        ];
    }
}
