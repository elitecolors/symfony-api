<?php

namespace App\Controller;

use App\Service\StockService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

class StockController extends AbstractController
{
    public function __construct(
        private readonly StockService $stockService,
    ) {
    }
    #[OA\Get(
        description: 'Stock Api',
        tags: ['stock'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'code 200, example array of objects.',
            ),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: 'code 400'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'code 500, ooops!'),
        ]
    )]
    #[Route('/api/stock', name: 'app_stock')]
    public function index(): JsonResponse
    {
        $stockData = $this->stockService->getStockData();

        return $this->json($stockData);
    }
}
