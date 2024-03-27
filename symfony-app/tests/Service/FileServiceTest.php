<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\File;
use App\Service\FileService;
use App\Tests\TestFileResource;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/** @coversDefaultClass \App\Service\FileService */
class FileServiceTest extends KernelTestCase
{
    private FileService|null $fileService = null;

    protected function setup(): void
    {
        parent::setUp();

        $this->fileService = $this->getContainer()->get(FileService::class);
    }

    protected function tearDown(): void
    {
        $this->fileService = null;

        parent::tearDown();
    }

    /**
     * @covers ::create
     */
    public function testCreateFile(): void
    {
        $fileResource = TestFileResource::getStockFile();
        $stockFile = $fileResource['stock_test'];

        $this->assertInstanceOf(UploadedFile::class, $stockFile);
        $splInfo = new SplFileInfo($stockFile->getRealPath(), $stockFile->getPath(), $stockFile->getBasename());

        $file = $this->fileService->create($splInfo);

        $this->assertInstanceOf(File::class, $file);
    }
}
