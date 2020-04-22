<?php

namespace App\Repositories;

use App\Models\Zip;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ZipRepositoryInterface
{

    /**
     * Inserts or updates data in storage DB.
     *
     * @param Collection $zipsCollection A collection of imported data.
     */
    public function insertOrUpdate(Collection $zipsCollection);

    /**
     * Search and returns information on ZIP code.
     *
     * @param int $zip Zip code to search.
     *
     * @return Zip
     */
    public function findByZip(int $zip): Zip;

    /**
     * Search and returns information on part of the city name.
     *
     * @param string    $cityPart   Part of the city name to search.
     * @param int       $perPage    Number of results per page
     *
     * @return LengthAwarePaginator
     */
    public function findByCityPart(string $cityPart, int $perPage = 2): LengthAwarePaginator;
}
