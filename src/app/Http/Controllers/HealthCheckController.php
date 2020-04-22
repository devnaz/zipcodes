<?php

namespace App\Http\Controllers;

use App\Http\Resources\HealthCheckResource;
use App\Services\HealthCheckServiceInterface;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;
use Exception;

/**
 * Health check endpoints.
 */
class HealthCheckController extends BaseController
{

    /**
     * Service access to functional checks.
     * @var HealthCheckServiceInterface
     */
    private $healthCheckService;

    /**
     * Setting the initial data.
     *
     * @param HealthCheckServiceInterface   $healthCheckService     Service access to functional checks.
     */
    public function __construct(HealthCheckServiceInterface $healthCheckService)
    {
        $this->healthCheckService = $healthCheckService;
    }

    /**
     * Checks functionality and returns verification statuses.
     *
     * @return HealthCheckResource
     */
    public function index()
    {
        try {
            return new HealthCheckResource(
                $this->healthCheckService->verification()
            );
        } catch (Exception $exception) {
            throw new HttpException(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                'Failed HealthCheck.'
            );
        }
    }
}
