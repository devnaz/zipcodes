<?php

namespace App\Listeners;

use App\Events\ImportCsvFileEvent;
use App\Repositories\ZipRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;

class ImportDBListener implements ShouldQueue
{

    use InteractsWithQueue, Queueable;

    /**
     * Access to ZIP codes in the storage DB.
     * @var ZipRepositoryInterface
     */
    private $zipRepository;

    /**
     * Setting input values.
     *
     * @param ZipRepositoryInterface $zipRepository Access to ZIP codes in the storage DB.
     */
    public function __construct(ZipRepositoryInterface $zipRepository)
    {
        $this->zipRepository = $zipRepository;
    }

    /**
     * Processing a data import event in a database repository.
     *
     * @param ImportCsvFileEvent $event Data Import Event.
     */
    public function handle(ImportCsvFileEvent $event)
    {
        $this->zipRepository->insertOrUpdate($event->getItems());
    }
}
