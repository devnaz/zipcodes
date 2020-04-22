<?php

namespace Tests\Unit\Events;

use App\Events\ImportCsvFileEvent;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ImportCsvFileEventTest extends TestCase
{

    /**
     * @var ImportCsvFileEvent
     */
    private $importCsvFileEvent;

    /**
     * @var Collection
     */
    private $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $collection = $this->prophesize(Collection::class);
        $this->collection = $collection->reveal();
        $this->importCsvFileEvent = new ImportCsvFileEvent(
            $this->collection
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->importCsvFileEvent = null;
        $this->collection = null;
    }

    public function testGetItems()
    {
        $this->assertEquals(
            $this->collection,
            $this->importCsvFileEvent->getItems()
        );
    }
}
