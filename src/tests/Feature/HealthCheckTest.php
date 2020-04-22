<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{

    use DatabaseMigrations;

    public function testHealthCheck()
    {
        $response = $this->get('/api/health-check');
        $response->assertStatus(Response::HTTP_OK);
        $data = $response->json();
        $this->assertTrue($data['mongodb-server']);
        $this->assertTrue($data['redis-server']);
    }
}
