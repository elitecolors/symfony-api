<?php

namespace App\Controller;

use App\Service\StockService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Serializer;

class StockController extends AbstractController
{
    public function __construct(
        private readonly StockService $stockService,
    ) {
    }
    #[Route('/stock', name: 'app_stock')]
    public function index(): JsonResponse
    {
        $stockData = $this->stockService->getStockData();

        return $this->json($stockData);
    }
}
