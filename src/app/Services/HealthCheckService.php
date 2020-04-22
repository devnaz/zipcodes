<?php

namespace App\Services;

use App\Presenters\HealthCheckPresenter;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Jenssegers\Mongodb\Connection;

/**
 * HealthCheck service.
 */
class HealthCheckService implements HealthCheckServiceInterface
{

    /**
     * Checks the performance of system nodes.
     *
     * @return HealthCheckPresenter
     */
    public function verification(): HealthCheckPresenter
    {
        return new HealthCheckPresenter(
            $this->checkMongoDbServer(),
            $this->checkRedisDbServer()
        );
    }

    /**
     * Checks mongodb database health.
     *
     * @return bool
     */
    private function checkMongoDbServer(): bool
    {
        try {
            /**
             * @var Connection $connection
             */
            $connection = DB::connection('mongodb');
            $connection->getMongoClient()->listDatabases();
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * Checks redis server health.
     *
     * @return bool
     */
    private function checkRedisDbServer()
    {
        try {
            Redis::connect();
            return true;
        } catch(Exception $exception) {
            return false;
        }
    }
}
