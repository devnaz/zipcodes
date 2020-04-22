<?php

namespace Tests\Unit\Services;

use App\Presenters\HealthCheckPresenter;
use App\Services\HealthCheckService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Prophecy\Prophecy\MethodProphecy;
use Tests\TestCase;
use Jenssegers\Mongodb\Connection;
use MongoDB\Client;
use MongoDB\Model\DatabaseInfoLegacyIterator;
use Exception;

class HealthCheckServiceTest extends TestCase
{

    /**
     * @var HealthCheckService
     */
    private $healthCheckService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->healthCheckService = new HealthCheckService();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        DB::clearResolvedInstances();
        Redis::clearResolvedInstances();
        $this->healthCheckService = null;
    }

    public function testVerificationOk()
    {
        $databaseInfoLegacyIterator = $this->prophesize(DatabaseInfoLegacyIterator::class);

        $client = $this->prophesize(Client::class);
        $client
            ->addMethodProphecy(
                (new MethodProphecy(
                    $client,
                    'listDatabases',
                    []
                ))->willReturn($databaseInfoLegacyIterator->reveal())
            );

        $connection = $this->prophesize(Connection::class);
        $connection
            ->addMethodProphecy(
                (new MethodProphecy(
                    $connection,
                    'getMongoClient',
                    []
                ))->willReturn($client->reveal())
            );

        DB::shouldReceive('connection')->with('mongodb')->andReturn($connection->reveal());

        Redis::shouldReceive('connect')->andReturnTrue();

        $healthCheckPresenter = $this->healthCheckService->verification();

        $this->assertInstanceOf(
            HealthCheckPresenter::class,
            $healthCheckPresenter
        );

        $this->assertEquals(
            [
                'mongodb-server' => true,
                'redis-server' => true,
            ],
            $healthCheckPresenter->toArray()
        );
    }

    public function testVerificationException()
    {
        DB::shouldReceive('connection')->with('mongodb')->andThrow(new Exception('Error'));
        Redis::shouldReceive('connect')->andThrow(new Exception('Error'));

        $healthCheckPresenter = $this->healthCheckService->verification();

        $this->assertInstanceOf(
            HealthCheckPresenter::class,
            $healthCheckPresenter
        );

        $this->assertEquals(
            [
                'mongodb-server' => false,
                'redis-server' => false,
            ],
            $healthCheckPresenter->toArray()
        );
    }
}
