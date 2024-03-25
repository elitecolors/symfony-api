<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\File;
use App\Repository\FileRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

class FileService
{
    private string $fileDestination;

    public function __construct(
        private readonly FileRepository $fileRepository,
        private readonly Filesystem $filesystem,
        private readonly ParameterBagInterface $parameterBag,
    ) {
        $this->fileDestination = $this->parameterBag->get('app.files.dir');
    }

    public function create(SplFileInfo $fileInfo): File
    {
        $file = File::create($fileInfo->getBasename(), $fileInfo->getRealPath());

        if ($this->filesystem->exists($this->fileDestination) === false) {
            $this->filesystem->mkdir($this->fileDestination);
        }

        $this->filesystem->copy(
            $fileInfo->getRealPath(),
            $this->fileDestination . '/' . $fileInfo->getBasename(),
            true
        ); // will be aws later on

        $this->fileRepository->save($file);

        return $file;
    }
}
