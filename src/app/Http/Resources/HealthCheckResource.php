<?php

namespace App\Http\Resources;

use App\Presenters\HealthCheckPresenter;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Response resource describing health check.
 */
class HealthCheckResource extends JsonResource
{

    /**
     * Setting input values.
     *
     * @param HealthCheckPresenter $resource HealthCheck data presenter.
     */
    public function __construct(HealthCheckPresenter $resource)
    {
        parent::__construct($resource);
        self::withoutWrapping();
    }
}
