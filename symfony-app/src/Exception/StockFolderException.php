<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class StockFolderException extends RuntimeException
{
    public function getMessageKey(): string
    {
        return 'Stock folder not exist';
    }
}
