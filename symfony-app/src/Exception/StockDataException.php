<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class StockDataException extends RuntimeException
{
    public function getMessageKey(): string
    {
        return 'Error parsing csv file';
    }
}
