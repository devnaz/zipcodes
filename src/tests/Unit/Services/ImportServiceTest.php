<?php

namespace Tests\Unit\Services;

use App\Exceptions\InvalidCSVFormatException;
use App\Repositories\ZipRepositoryInterface;
use App\Services\ImportService;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ImportServiceTest extends TestCase
{

    /**
     * @var ImportService
     */
    private $importService;

    protected function setUp(): void
    {
        parent::setUp();
        $zipRepository = $this->prophesize(ZipRepositoryInterface::class);

        $this->importService = new ImportService(
            $zipRepository->reveal()
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->importService = null;
    }

    public function testParseCSVFileInvalidCSVFormatException1()
    {
        $this->expectException(InvalidCSVFormatException::class);

        $collection = $this->importService->parseCSVFile('');
        $this->assertInstanceOf(
            Collection::class,
            $collection
        );

    }

    public function testParseCSVFileInvalidCSVFormatException2()
    {
        $this->expectException(InvalidCSVFormatException::class);

        $collection = $this->importService->parseCSVFile('id,zip,country' . PHP_EOL . '1,2,3');
        $this->assertInstanceOf(
            Collection::class,
            $collection
        );

    }

    public function testParseCSVFileInvalidCSVFormatException3()
    {
        $this->expectException(InvalidCSVFormatException::class);

        $collection = $this->importService->parseCSVFile('id,code,city' . PHP_EOL . '1,2,3');
        $this->assertInstanceOf(
            Collection::class,
            $collection
        );

    }

    public function testParseCSVFile()
    {
        $collection = $this->importService->parseCSVFile('id,zip,city' . PHP_EOL . '1,2,3');
        $this->assertInstanceOf(
            Collection::class,
            $collection
        );
        $this->assertEquals(
            [
                [
                    'zip' => 2,
                    'city' => 3
                ],
            ],
            $collection->toArray()
        );
    }
}
