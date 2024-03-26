<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerService
{
    public function __construct(private readonly SerializerInterface $serializer) {}

    /** @param array<int,string> $groups */
    public function serializeGroup(mixed $object, array $groups, string $format = 'json'): string
    {
        $context = [
            ObjectNormalizer::GROUPS => $groups,
            ObjectNormalizer::ENABLE_MAX_DEPTH
        ];

        return $this->serializer->serialize($object, $format, $context);
    }
}
