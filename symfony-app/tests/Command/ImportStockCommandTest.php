<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\ImportStockCommand;
use App\Service\StockService;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/** @coversDefaultClass \App\Command\ImportStockCommand */
class ImportStockCommandTest extends TestCase
{
    private ImportStockCommand $command;
    private CommandTester $tester;
    private ParameterBagInterface|MockObject $parameterBag;
    private Filesystem|MockObject $filesystem;
    private StockService|MockObject $stockService;

    protected function setUp(): void
    {
        $this->parameterBag = $this->createMock(ParameterBagInterface::class);
        $this->filesystem = $this->createMock(Filesystem::class);
        $this->stockService = $this->createMock(StockService::class);

        $this->command = new ImportStockCommand($this->parameterBag, $this->filesystem, $this->stockService);
        $application = new Application();
        $application->add($this->command);
        $this->tester = new CommandTester($this->command);
    }

    /**
     * @covers ::execute
     */
    public function testExecuteWithNonExistingFolder(): void
    {
        $this->parameterBag->method('get')->willReturn('/path/to/non_existing_folder');
        $this->filesystem->method('exists')->willReturn(false);

        $this->tester->execute([]);
        $output = $this->tester->getDisplay();

        $this->assertStringContainsString('folder stock not exist', $output);
        $this->assertEquals(ImportStockCommand::FAILURE, $this->tester->getStatusCode());
    }
}
