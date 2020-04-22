<?php

namespace App\Repositories;

use App\Models\Zip;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

/**
 * API access storage DB.
 */
class ZipRepository implements ZipRepositoryInterface
{

    /**
     * Inserts or updates data in storage DB.
     *
     * @param Collection $zipsCollection A collection of imported data.
     */
    public function insertOrUpdate(Collection $zipsCollection)
    {
        /**
         * MongoDB client session.
         * @var Session $session
         */
        $session = DB::getMongoClient()->startSession();
        $session->startTransaction([]);
        foreach ($zipsCollection as $zipCode) {
            Zip::query()->updateOrCreate(['zip' => $zipCode['zip']], $zipCode);
        }
        $session->commitTransaction();
    }

    /**
     * Search and returns information on ZIP code.
     *
     * @param int $zip Zip code to search.
     *
     * @return Zip
     */
    public function findByZip(int $zip): Zip
    {
        return Zip::query()->where('zip', '=', $zip)->firstOrFail();
    }

    /**
     * Search and returns information on part of the city name.
     *
     * @param string    $cityPart   Part of the city name to search.
     * @param int       $perPage    Number of results per page
     *
     * @return LengthAwarePaginator
     */
    public function findByCityPart(string $cityPart, int $perPage = 20): LengthAwarePaginator
    {
        return Zip::query()
            ->where('city', 'like', '%' . $cityPart . '%')
            ->paginate($perPage);
    }
}
