<?php

namespace Tests\Unit\Presenters;

use App\Presenters\HealthCheckPresenter;
use Tests\TestCase;

class HealthCheckPresenterTest extends TestCase
{

    /**
     * @var HealthCheckPresenter
     */
    private $healthCheckPresenter;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->healthCheckPresenter = null;
    }

    public function testDBStatusTrue()
    {
        $this->healthCheckPresenter = new HealthCheckPresenter(true, true);

        $this->assertEquals(
            [
                'mongodb-server' => true,
                'redis-server' => true,
            ],
            $this->healthCheckPresenter->toArray()
        );
    }

    public function testDBStatusFalse()
    {
        $this->healthCheckPresenter = new HealthCheckPresenter(false, false);

        $this->assertEquals(
            [
                'mongodb-server' => false,
                'redis-server' => false,
            ],
            $this->healthCheckPresenter->toArray()
        );
    }
}
