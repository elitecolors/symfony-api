<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enums\SerializerEnum;
use App\Service\SerializerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    public function __construct(
        protected SerializerService $serializer,
    ) {
    }

    /**
     * Return our standard success response
     */
    public function createSuccessResponse(): Response
    {
        return $this->createApiResponse(['data' => ['success' => true]]);
    }

    protected function createApiResponse(
        $data,
        $statusCode = Response::HTTP_OK,
        $groups = [SerializerEnum::DEFAULT_SERIALIZATION_GROUP->value],
    ): Response {
        $json = $this->serialize($data, $groups);

        return new Response($json, $statusCode, ['Content-Type' => 'application/json']);
    }

    protected function serialize($data, $groups, $format = 'json'): string
    {
        return $this->serializer->serializeGroup($data, $groups, $format);
    }
}
