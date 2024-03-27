<?php

namespace App\Command;

use App\Exception\StockDataException;
use App\Service\StockService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'app:import-stock',
    description: 'Command to import stock data from file',
)]
class ImportStockCommand extends Command
{
    public function __construct(
        private readonly ParameterBagInterface $parameterBag,
        private readonly Filesystem $filesystem,
        private readonly StockService $stockService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('start command');

        $stockFolder = $this->parameterBag->get('app.stock.dir');

        $io->note('check if stock folder exist: '.$stockFolder);

        if (false === $this->filesystem->exists($stockFolder)) {
            $io->error('folder stock not exist !');

            return Command::FAILURE;
        }

        $io->note('get all files from stock folder');
        $finder = new Finder();

        $finder->files()->in($stockFolder);

        if (0 === $finder->count()) {
            $io->warning('empty stock folder');

            return Command::SUCCESS;
        }

        foreach ($finder as $file) {
            try {
                $this->stockService->importDataFromFile($file);
            } catch (StockDataException) {
                $io->warning('error parsing data from file: '.$file->getBasename());
                continue;
            }
        }

        $io->success('Data imported');

        return Command::SUCCESS;
    }
}
