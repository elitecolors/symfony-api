<?php

declare(strict_types=1);

namespace App\Controller;

use App\Definition\ProductDTO;
use App\Form\ProductType;
use App\Service\ProductService;
use App\Service\SerializerService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/product', name: 'app_product')]
class ProductController extends BaseController
{
    public function __construct(
        SerializerService $serializer,
        private readonly ProductService $productService,
    ) {
        parent::__construct($serializer);
    }

    #[OA\Post(
        description: 'Add product',
        tags: ['product'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Product added !'
            ),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: 'form errors 400'),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'code 500, ooops!'),
        ]
    )]
    #[Route('', name: '_add', methods: 'POST')]
    public function addProduct(Request $request): Response
    {
        $productDto = new ProductDTO();
        $form = $this->createForm(ProductType::class, $productDto);

        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $this->productService->create($productDto);

            return $this->createApiResponse(['data' => $product]);
        }

        $errors = $this->getFormErrors($form);

        return $this->createApiResponse(['errors' => $errors], Response::HTTP_BAD_REQUEST);
    }
}
