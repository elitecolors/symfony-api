<?php

declare(strict_types=1);

namespace App\Enums;

enum SerializerEnum: string
{
    case DEFAULT_SERIALIZATION_GROUP = 'serializeGroup';
    case ANONYMOUS_SERIALIZATION_GROUP = 'anonymousSerializeGroup';
}
