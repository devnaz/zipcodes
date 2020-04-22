<?php

namespace App\Presenters;

/**
 * HealthCheck data presenter.
 */
class HealthCheckPresenter
{

    /**
     * Indicates the mongoDB state of the server.
     * @var bool
     */
    private $mongodbServerStatus;

    /**
     * Indicates the redis state of the server.
     * @var bool
     */
    private $redisDbServerStatus;

    /**
     * Setting the initial data.
     *
     * @param bool $mongodbServerStatus MongoDB state of the server.
     * @param bool $redisDbServerStatus Redis state of the server.
     */
    public function __construct(bool $mongodbServerStatus, bool $redisDbServerStatus)
    {
        $this->mongodbServerStatus = $mongodbServerStatus;
        $this->redisDbServerStatus = $redisDbServerStatus;
    }

    /**
     * Convert the presenter instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'mongodb-server' => $this->mongodbServerStatus,
            'redis-server' => $this->redisDbServerStatus,
        ];
    }
}
