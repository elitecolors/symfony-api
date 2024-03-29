<?php

declare(strict_types=1);

namespace App\Service;

use App\Definition\ProductDTO;
use App\Entity\Product;
use App\Repository\ProductRepository;

readonly class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
    )
    {
    }

    public function create(ProductDTO $productDTO): Product
    {
        $product = Product::create($productDTO->getCode(), $productDTO->getQty());

        $this->productRepository->save($product, true);

        return $product;
    }

    public function getProductByCode(string $code): Product|null
    {
        return $this->productRepository->findOneBy(['code' => $code]);
    }
}
