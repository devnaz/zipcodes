<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Exception;

interface ImportServiceInterface
{

    /**
     * Parsing the CSV file and preparing data for import into the DB storage.
     * Returns prepared data for data import.
     *
     * @param string $csvFileContent CSV file content.
     *
     * @return Collection
     *
     * @throws Exception
     */
    public function parseCSVFile(string $csvFileContent): Collection;
}
