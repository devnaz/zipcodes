<?php

namespace App\Services;

use App\Presenters\HealthCheckPresenter;

/**
 * HealthCheck service API.
 */
interface HealthCheckServiceInterface
{

    /**
     * Checks the performance of system nodes.
     *
     * @return HealthCheckPresenter
     */
    public function verification(): HealthCheckPresenter;
}
