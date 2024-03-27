<?php

declare(strict_types=1);

namespace App\Service;

use App\Definition\ProductDTO;
use App\Definition\StockData;
use App\Entity\Product;
use App\Entity\Stock;
use App\Exception\StockDataException;
use App\Repository\StockRepository;
use League\Csv\Exception;
use League\Csv\UnavailableStream;
use Symfony\Component\Finder\SplFileInfo;

class StockService
{
    public function __construct(
        private readonly FileService $fileService,
        private readonly ProductService $productService,
        private readonly StockRepository $stockRepository,
    ) {
    }

    public function importDataFromFile(SplFileInfo $splFileInfo): void
    {
        try {
            $data = CsvService::getData($splFileInfo->getRealPath());
        } catch (UnavailableStream|Exception) {
            throw new StockDataException();
        }

        if ([] === $data) {
            return;
        }

        $this->fileService->create($splFileInfo);

        foreach ($data as $stockData) {
            assert($stockData instanceof StockData);

            $product = $this->productService->getProductByCode($stockData->getCode());

            if (null === $product) {
                $productDto = ProductDTO::create(
                    $stockData->getQuantity(),
                    $stockData->getCode(), '0'
                );

                $product = $this->productService->create($productDto);
            }

            $this->manageStock($product, $stockData);
        }

        $this->stockRepository->forceFlush();
    }

    public function manageStock(Product $product, StockData $stockData): void
    {
        $stock = $this->stockRepository->findOneBy(['product' => $product]);

        if (null === $stock) {
            $this->create($product, $stockData);

            return;
        }

        $this->update($stock, $stockData);
    }

    public function create(Product $product, StockData $stockData): Stock
    {
        $stock = new Stock();
        $stock->setProduct($product);
        $stock->setQuantity($stockData->getQuantity());

        $this->stockRepository->save($stock);

        return $stock;
    }

    public function update(Stock $stock, StockData $stockData): Stock
    {
        $stock->setQuantity($stockData->getQuantity());

        $this->stockRepository->save($stock);

        return $stock;
    }

    /**
     * @return array<Stock>
     */
    public function getStockData(): array
    {
        return $this->stockRepository->findAll();
    }
}
