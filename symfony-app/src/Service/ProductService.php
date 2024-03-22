<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductService
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function create(string $code, int $qty): Product
    {
        $product = Product::create($code, $qty);

        $this->productRepository->save($product);

        return $product;
    }

    public function getProductByCode(string $code): Product|null
    {
        return $this->productRepository->findOneBy(['code' => $code]);
    }
}
