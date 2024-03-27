<?php

declare(strict_types=1);

namespace App\Definition;

use Symfony\Component\Validator\Constraints as Assert;

final class ProductDTO
{
    #[Assert\NotNull]
    private string $code;
    private string $price;
    #[Assert\NotNull]
    private int $qty;

    public static function create(int $qty, string $code, string $price): self
    {
        $dto = new self();

        $dto->qty = $qty;
        $dto->code = $code;
        $dto->price = $price;

        return $dto;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }
}
