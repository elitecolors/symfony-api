<?php

namespace App\Controller;

use App\Service\SerializerService;
use App\Service\StockService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StockController extends BaseController
{
    public function __construct(
        SerializerService $serializer,
        private readonly StockService $stockService,
    ) {
        parent::__construct($serializer);
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
    public function index(): Response
    {
        $stockData = $this->stockService->getStockData();

        return $this->createApiResponse(['data' => $stockData]);
    }
}
