<?php

declare(strict_types=1);

namespace App\Definition;

final class StockData
{
    private string $code;
    private int $quantity;

    public static function create(string $code, int $qty): self
    {
        $stock = new self();
        $stock->code = $code;
        $stock->quantity = $qty;

        return $stock;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
