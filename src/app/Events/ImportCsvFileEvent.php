<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

/**
 * DB Data Import Event.
 */
class ImportCsvFileEvent
{

    use SerializesModels;

    /**
     * Imported data.
     * @var Collection
     */
    private $collection;

    /**
     * Setting input values.
     *
     * @param Collection $collection Imported data.
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Returns a collection of imported data.
     *
     * @return Collection
     */
    public function getItems()
    {
        return $this->collection;
    }
}
