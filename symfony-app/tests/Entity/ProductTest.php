<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

/** @coversDefaultClass \App\Entity\Product */
class ProductTest extends TestCase
{
    /**
     * @covers ::create
     */
     public function testCreateProduct(): void
    {
        $product = Product::create('test', 1);
        $this->assertInstanceOf(Product::class, $product);

        $this->assertSame($product->getCode(), 'test');
        $this->assertSame($product->getQuantity(), 1);
    }
}
