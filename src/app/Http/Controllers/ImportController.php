<?php

namespace App\Http\Controllers;

use App\Events\ImportCsvFileEvent;
use App\Http\Resources\ImportResource;
use App\Services\ImportServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ImportController extends BaseController
{

    /**
     * Raises a data import event.
     *
     * @param Request $request Incoming request
     * @param ImportServiceInterface $importService Service for importing data from various sources.
     *
     * @return ImportResource
     */
    public function store(Request $request, ImportServiceInterface $importService)
    {
        /**
         * Basic file upload check.
         */
        if (
            !($request->hasFile('db')) ||
            !($request->file('db')->isValid())
        ) {
            throw new HttpException(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                'File upload error.'
            );
        }

        /**
         * Parsing the incoming file and creating a data import event.
         */
        try {
            event(
                new ImportCsvFileEvent(
                    $importService->parseCSVFile(
                        trim($request->file('db')->get())
                    )
                )
            );
            return new ImportResource();
        } catch (Exception $exception) {
            throw new HttpException(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $exception->getMessage()
            );
        }
    }
}
