<?php

declare(strict_types=1);

namespace App\Service;

use App\Definition\StockData;
use App\Exception\StockDataException;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\SyntaxError;
use League\Csv\UnavailableStream;

use function array_intersect;

class CsvService
{
    /**
     * @throws UnavailableStream
     * @throws SyntaxError
     * @throws Exception
     *
     * @return array<StockData>
     */
    public static function getData(string $filePath): array
    {
        $csv = Reader::createFromPath($filePath);

        $csv->setHeaderOffset(0); // Skip the header row

        if (false === self::ensureCsvFileStructureAction($csv->getHeader())) {
            throw new StockDataException('wrong file data !');
        }

        $records = $csv->getRecords();

        $data = [];
        foreach ($records as $record) {
            $stockData = StockData::create($record['Sku_code'], (int) $record['quantity']);
            $data[] = $stockData;
        }

        return $data;
    }

    /**
     * @param array<string,string> $header
     */
    public static function ensureCsvFileStructureAction(array $header): bool
    {
        $headerStructure = ['Sku_code', 'quantity'];

        $intersect = array_intersect($headerStructure, $header);

        return $headerStructure === $intersect;
    }
}
