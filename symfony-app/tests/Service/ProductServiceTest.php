<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Product;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @coversDefaultClass \App\Service\ProductService */
class ProductServiceTest extends KernelTestCase
{
    private ProductService|null $productService = null;

    protected function setup(): void
    {
        parent::setUp();

        $this->productService = $this->getContainer()->get(ProductService::class);
    }

    protected function tearDown(): void
    {
        $this->productService = null;

        parent::tearDown();
    }

    /**
     * @dataProvider createProductProvider
     *
     * @covers ::create
     */
    public function testCreate(string $code, int $qty): void
    {
        $product = $this->productService->create($code, $qty);

        $this->assertInstanceOf(Product::class, $product);

        $this->assertSame($product->getQuantity(), $qty);
        $this->assertSame($product->getCode(), $code);
    }

    public function createProductProvider(): array
    {
        return [
            'Product 1' => [
                'code1',
                1,
            ],
            'Product 2' => [
                'code2',
                5,
            ],
            'Product 3' => [
                'code3',
                6,
            ],
        ];
    }
}
