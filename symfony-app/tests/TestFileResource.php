<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class TestFileResource
{
    /**
     * @return UploadedFile[]
     */
    public static function getStockFile(string $name = 'stock_test'): array
    {
        return self::getResourceFile('stock_test.csv', $name);
    }

    /**
     * @return UploadedFile[]
     */
    public static function getResourceFile(string $fileName, string $keyName, string|null $mimeType = null): array
    {
        $path = self::getResourcesPath($fileName);

        return [$keyName => new UploadedFile($path, $fileName, $mimeType, null, true)];
    }

    public static function getResourcesPath(string $fileName): string
    {
        return __DIR__.'/Resources/'.$fileName;
    }
}
