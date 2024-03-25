<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\File;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\TestCase;

/** @coversDefaultClass \App\Entity\File */
class FileTest extends TestCase
{
    /**
     * @covers ::create
     */
    #[NoReturn] public function testCreateFile(): void
    {
        $file = File::create('test_file', 'local/dur');
        $this->assertInstanceOf(File::class, $file);

        $this->assertSame($file->getOriginalName(), 'test_file');
        $this->assertSame($file->getFilePath(), 'local/dur');
    }
}
