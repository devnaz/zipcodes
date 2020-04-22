<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\HealthCheckResource;
use App\Presenters\HealthCheckPresenter;
use Prophecy\Prophecy\MethodProphecy;
use Tests\TestCase;

class HealthCheckResourceTest extends TestCase
{

    /**
     * @var HealthCheckResource
     */
    private $healthCheckResource;

    protected function setUp(): void
    {
        parent::setUp();
        $healthCheckPresenter = $this->prophesize(HealthCheckPresenter::class);
        $healthCheckPresenter
            ->addMethodProphecy(
                (new MethodProphecy(
                    $healthCheckPresenter,
                    'toArray',
                    []
                ))->willReturn([
                    'status' => 'test'
                ])
            );

        $this->healthCheckResource = new HealthCheckResource($healthCheckPresenter->reveal());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->healthCheckResource = null;
    }

    public function testToArray()
    {
        $this->assertEquals(
            [
                'status' => 'test'
            ],
            $this->healthCheckResource->toArray(null)
        );
    }
}
