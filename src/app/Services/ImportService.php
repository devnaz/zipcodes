<?php

namespace App\Services;

use App\Exceptions\InvalidCSVFormatException;
use App\Repositories\ZipRepositoryInterface;
use Illuminate\Support\Collection;
use Exception;

/**
 * Service for importing data from various sources.
 */
class ImportService implements ImportServiceInterface
{

    /**
     * Access to ZIP codes in the storage DB.
     * @var ZipRepositoryInterface
     */
    private $zipRepository;

    /**
     * Setting initial data.
     *
     * @param ZipRepositoryInterface $zipRepository Access to ZIP codes in the storage DB.
     */
    public function __construct(ZipRepositoryInterface $zipRepository)
    {
        $this->zipRepository = $zipRepository;
    }

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
    public function parseCSVFile(string $csvFileContent): Collection
    {
        /**
         * List of supported fields with column keys.
         */
        $fieldKeys = [
            'zip' => false,
            'city' => false,
        ];

        $zipsCollection = new Collection();
        foreach (
            array_map(
                'str_getcsv',
                explode(PHP_EOL, $csvFileContent)
            ) as $lineIndex => $lineFields
        ) {
            /**
             * The first line defines the columns used to fill.
             */
            if (0 == $lineIndex) {
                $fieldKeys = $this->initDefiningFillColumns($fieldKeys, $lineFields);
                continue;
            }

            $zipsCollection->add($this->buildZipData($fieldKeys, $lineFields));
        }

        return $zipsCollection;
    }

    /**
     * Defining fill columns.
     * Returns supported fields and their column indices.
     *
     * @param array $fieldKeys      List of supported fields with column keys.
     * @param array $lineFields     Import record fields.
     *
     * @return array
     *
     * @throws Exception
     */
    private function initDefiningFillColumns(array $fieldKeys, array $lineFields): array
    {
        foreach (array_keys($fieldKeys) as $fieldKey) {
            $index = array_search($fieldKey, $lineFields);
            if (false === $index) {
                throw new InvalidCSVFormatException('Not all required fields: ' . $fieldKey);
            }
            $fieldKeys[$fieldKey] = $index;
        }
        return $fieldKeys;
    }

    /**
     * Build data to fill storage DB.
     * Returns prepared data for filling the storage DB.
     *
     * @param array $fieldKeys      List of supported fields with column keys.
     * @param array $lineFields     Import record fields.
     *
     * @return array
     */
    private function buildZipData(array $fieldKeys, array $lineFields): array
    {
        $zipCodeData = [];
        foreach (array_keys($fieldKeys) as $fieldKey) {
            $value = $lineFields[$fieldKeys[$fieldKey]];
            $zipCodeData[$fieldKey] = ('zip' == $fieldKey ? (int)$value : $value);
        }
        return $zipCodeData;
    }
}
