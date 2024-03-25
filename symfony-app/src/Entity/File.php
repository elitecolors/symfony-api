<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string|null $originalName = null;

    #[ORM\Column(length: 255)]
    private string|null $filePath = null;

    #[ORM\Column(length: 255)]
    private string|null $fullPath = null;

    #[ORM\Column]
    private DateTimeImmutable|null $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct(
        string $fileName,
        string $filePath
    ) {
        $this->originalName = $fileName;
        $this->filePath = $filePath;
        $this->createdAt = new DateTimeImmutable();
        $this->fullPath = $filePath;
    }

    public static function create(string $fileName, string $filePath): self
    {
        return new self($fileName, $filePath);
    }

    public function getOriginalName(): string|null
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): static
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getFilePath(): string|null
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): static
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getFullPath(): string|null
    {
        return  $this->fullPath;
    }

    public function setFullPath(string $fullPath): static
    {
        $this->fullPath = $fullPath;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
