<?php

namespace Tests\Unit\Listeners;

use App\Events\ImportCsvFileEvent;
use App\Listeners\ImportDBListener;
use App\Repositories\ZipRepositoryInterface;
use Illuminate\Support\Collection;
use Prophecy\Prophecy\MethodProphecy;
use Tests\TestCase;

class ImportDBListenerTest extends TestCase
{

    /**
     * @var ImportDBListener
     */
    private $importDBListener;

    /**
     * @var Collection
     */
    private $collection;

    protected function setUp(): void
    {
        parent::setUp();
        $collection = $this->prophesize(Collection::class);
        $this->collection = $collection->reveal();

        $zipRepository = $this->prophesize(ZipRepositoryInterface::class);

        new MethodProphecy(
            $zipRepository,
            'insertOrUpdate',
            [$collection]
        );

        $this->importDBListener = new ImportDBListener(
            $zipRepository->reveal()
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->importDBListener = null;
    }

    public function testHandle()
    {
        $importCsvFileEvent = $this->prophesize(ImportCsvFileEvent::class);
        $importCsvFileEvent
            ->addMethodProphecy(
                (new MethodProphecy(
                    $importCsvFileEvent,
                    'getItems',
                    []
                ))->willReturn($this->collection)
            );

        $this->assertNull(
            $this->importDBListener->handle(
                $importCsvFileEvent->reveal()
            )
        );
    }

}
