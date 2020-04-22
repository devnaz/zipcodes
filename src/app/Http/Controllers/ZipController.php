<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZipResource;
use App\Repositories\ZipRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;

class ZipController extends BaseController
{

    /**
     * Returns information by zip code.
     *
     * @param int               $zip            Zip code to search.
     * @param ZipRepository     $zipRepository  API access storage DB.
     *
     * @return ZipResource
     */
    public function showByZip(int $zip, ZipRepository $zipRepository): ZipResource
    {
        try {
            $zipModel = $zipRepository->findByZip($zip);
        } catch (Exception $exception) {
            throw new HttpException(
                Response::HTTP_NOT_FOUND,
                'Record not found'
            );
        }
        return new ZipResource($zipModel);
    }

    /**
     * Returns partial city name information.
     *
     * @param string            $city               Part of the city name to search.
     * @param ZipRepository     $zipRepository      API access storage DB.
     *
     * @return AnonymousResourceCollection
     */
    public function showByCity(string $city, ZipRepository $zipRepository): AnonymousResourceCollection
    {
        try {
            $zipCollection = $zipRepository->findByCityPart($city);
        } catch (Exception $exception) {
            throw new HttpException(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                'Unable to complete request.'
            );
        }
        return ZipResource::collection($zipCollection);
    }
}
