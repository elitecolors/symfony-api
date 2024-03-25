<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use DateTimeImmutable;
use JetBrains\PhpStorm\NoReturn;

#[ORM\Entity(repositoryClass: StockRepository::class)]
#[HasLifecycleCallbacks]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne]
    private Product|null $product = null;

    #[ORM\Column]
    private int|null $quantity = null;

    #[ORM\Column(nullable: true)]
    private DateTimeImmutable|null $updateAt = null;

    #[ORM\Column]
    private DateTimeImmutable|null $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): int|null
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUpdateAt(): DateTimeImmutable|null
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeImmutable|null $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable|null
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    #[NoReturn] #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updateAt = new DateTimeImmutable();
    }
}
