<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enums\SerializerEnum;
use App\Service\SerializerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    public function __construct(
        protected SerializerService $serializer,
    ) {
    }

    /**
     * Return our standard success response.
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

    // Helper function to get form errors
    public function getFormErrors(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors(true, true) as $error) {
            $errors[] = $error->getMessage();
        }

        $childErrors = $this->getChildFormErrors($form);
        if (!empty($childErrors)) {
            $errors['children'] = $childErrors;
        }

        return $errors;
    }

    // Helper function to get child form errors
    private function getChildFormErrors(FormInterface $form): array
    {
        $errors = [];

        /** @var FormInterface $child */
        foreach ($form->all() as $child) {
            if ($child instanceof FormInterface) {
                $childErrors = $this->getFormErrors($child);
                if (!empty($childErrors)) {
                    $errors[$child->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}
