<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Response resource when importing data
 */
class ImportResource extends JsonResource
{

    /**
     * Setting input values.
     */
    public function __construct()
    {
        parent::__construct(null);
        self::withoutWrapping();
    }

    /**
     * Sets the HTTP response code.
     *
     * @param Request       $request    HTTP request.
     * @param JsonResponse  $response   Json response.
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
